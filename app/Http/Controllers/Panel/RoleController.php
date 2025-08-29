<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Panel\{
    StoreRoleRequest,
    UpdateRoleRequest,
};
use App\Services\{
    RoleService,
    ListService,
};
use Illuminate\Support\Facades\{
    Cache,
    Log,
};
use Illuminate\Validation\ValidationException;
use Throwable;
use App\Constants\ListDefaults;
use App\Traits\RedisCachable;

class RoleController extends Controller
{
    use RedisCachable;

    public function __construct(protected RoleService $service) {}

    public function index(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string',
            'status' => 'nullable|in:0,1',
        ]);

        $filters = $request->only(['name', 'status']);
        $roles = $this->service->paginate(
            ListDefaults::PER_PAGE, 
            ListDefaults::COLUMNS, 
            $filters
        );
        $statusList = (new ListService())->statusList();
        $sl = ($roles->currentPage() - 1) * $roles->perPage() + 1;

        return view('panel.roles.index', compact('roles', 'statusList', 'sl'));
    }

    public function create()
    {
        $statusList = (new ListService())->statusList();
        $modules = (new ListService())->moduleWithSubmoduleList();

        return view('panel.roles.create', compact('statusList', 'modules'));
    }

    public function show($role)
    {
        $role = $this->service->find($role);

        if (!$role) {
            return response()->json(['status' => false, 'message' => 'No record found.']);
        }

        $html = view('panel.roles.detail-modal', compact('role'))->render();

        return response()->json(['status' => true, 'data' => $html]);
    }

    public function store(StoreRoleRequest $request)
    {
        try {
            $validated = $request->validated();
            $role = $this->service->store($validated);
            $role->permissions()->sync($validated['permissions'] ?? []);
            $this->redisSet("role_permissions:{$role->id}", $role->permissions()->pluck('name')->toArray());

            Log::channel('panel')->info('Role created successfully: ', [
                'ip' => $request->ip(),
            ]);

            return redirect()->route('panel.roles.index')
                ->with('success', 'Role created successfully.');
        } catch (ValidationException $e) {
            Log::channel('panel')->warning('Failed to create role: ', [
                'errors' => $e->errors(),
                'ip' => $request->ip(),
            ]);

            return back()->withErrors($e->errors())->withInput();
        } catch (Throwable $e) {
            Log::channel('panel')->error('Something went wrong. Please try again: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'ip' => $request->ip(),
            ]);

            return back()->withErrors(['error' => 'Something went wrong. Please try again.']);
        }
    }

    public function edit($id)
    {
        $role = $this->service->find($id);
        $statusList = (new ListService())->statusList();
        $modules = (new ListService())->moduleWithSubmoduleList();
        $rolePermissions = $role->permissions()->pluck('id')->toArray();

        return view('panel.roles.edit', compact('role', 'statusList', 'modules', 'rolePermissions'));
    }

    public function update(UpdateRoleRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            $role = $this->service->update($id, $validated);
            $role->permissions()->sync($validated['permissions'] ?? []);
            $this->redisForget("role_permissions:{$role->id}");
            $this->redisSet("role_permissions:{$role->id}", $role->permissions()->pluck('name')->toArray());

            Log::channel('panel')->info('Role updated successfully: ', [
                'ip' => $request->ip(),
            ]);

            return redirect()->route('panel.roles.index')->with('success', 'Role updated successfully.');
        } catch (ValidationException $e) {
            Log::channel('panel')->warning('Failed to update role: ', [
                'errors' => $e->errors(),
                'ip' => $request->ip(),
            ]);

            return back()->withErrors($e->errors())->withInput();
        } catch (Throwable $e) {
            Log::channel('panel')->error('Something went wrong. Please try again: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'ip' => $request->ip(),
            ]);

            return back()->withErrors(['error' => 'Something went wrong. Please try again.']);
        }
    }

    public function destroy($id)
    {
        try {
            $role = $this->service->find($id);
            $this->redisForget("role_permissions:{$role->id}");
            $role->delete();

            Log::channel('panel')->info('Role deleted successfully: ', [
                'ip' => request()->ip(),
            ]);

            return redirect()->route('panel.roles.index')->with('success', 'Role deleted successfully.');
        } catch (ValidationException $e) {
            Log::channel('panel')->warning('Failed to delete role: ', [
                'errors' => $e->errors(),
                'ip' => request()->ip(),
            ]);

            return back()->withErrors($e->errors());
        } catch (Throwable $e) {
            Log::channel('panel')->error('Something went wrong. Please try again: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'ip' => request()->ip(),
            ]);

            return back()->withErrors(['error' => 'Something went wrong. Please try again.']);
        }
    }
}
