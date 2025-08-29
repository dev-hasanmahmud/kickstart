<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Panel\{
    StorePermissionRequest,
    UpdatePermissionRequest,
};
use App\Services\{
    PermissionService,
    ListService,
};
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;
use App\Constants\ListDefaults;

class PermissionController extends Controller
{
    public function __construct(protected PermissionService $service) {}

    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string',
            'status' => 'nullable|in:0,1',
        ]);

        $filters = $request->only(['search', 'status']);
        $permissions = $this->service->paginate(
            ListDefaults::PER_PAGE, 
            ListDefaults::COLUMNS, 
            $filters
        );
        $statusList = (new ListService())->statusList();
        $sl = ($permissions->currentPage() - 1) * $permissions->perPage() + 1;

        return view('panel.permissions.index', compact('permissions', 'statusList', 'sl'));
    }

    public function create()
    {
        $moduleList = (new ListService())->moduleList();
        $subModuleList = (new ListService())->subModuleList();
        $statusList = (new ListService())->statusList();

        return view('panel.permissions.create', compact('moduleList', 'subModuleList', 'statusList'));
    }

    public function show($permission)
    {
        $permission = $this->service->find($permission);

        if (!$permission) {
            return response()->json(['status' => false, 'message' => 'No record found.']);
        }

        $html = view('panel.permissions.detail-modal', compact('permission'))->render();

        return response()->json(['status' => true, 'data' => $html]);
    }

    public function store(StorePermissionRequest $request)
    {
        try {
            $permission = $this->service->store($request->validated());

            Log::channel('panel')->info('Permission created successfully: ', [
                'ip' => $request->ip(),
            ]);

            return redirect()->route('panel.permissions.index')
                ->with('success', 'Permission created successfully.');
        } catch (ValidationException $e) {
            Log::channel('panel')->warning('Failed to create permission: ', [
                'errors' => $e->errors(),
                'ip' => $request->ip(),
            ]);

            return back()->withErrors($e->errors());
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
        $permission = $this->service->find($id);
        $moduleList = (new ListService())->moduleList();
        $subModuleList = (new ListService())->subModuleList();
        $statusList = (new ListService())->statusList();

        return view('panel.permissions.edit', compact('permission', 'moduleList', 'subModuleList', 'statusList'));
    }

    public function update(UpdatePermissionRequest $request, $id)
    {
        try {
            $this->service->update($id, $request->validated());

            Log::channel('panel')->info('Permission updated successfully: ', [
                'ip' => $request->ip(),
            ]);

            return redirect()->route('panel.permissions.index')->with('success', 'Permission updated successfully.');
        } catch (ValidationException $e) {
            Log::channel('panel')->warning('Failed to update permission: ', [
                'errors' => $e->errors(),
                'ip' => $request->ip(),
            ]);

            return back()->withErrors($e->errors());
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
            $permission = $this->service->find($id);
            $permission->delete();

            Log::channel('panel')->info('Permission deleted successfully: ', [
                'ip' => request()->ip(),
            ]);

            return redirect()->route('panel.permissions.index')->with('success', 'Permission deleted successfully.');
        } catch (ValidationException $e) {
            Log::channel('panel')->warning('Failed to delete permission: ', [
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
