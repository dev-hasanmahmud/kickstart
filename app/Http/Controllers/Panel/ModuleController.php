<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Panel\{
    StoreModuleRequest,
    UpdateModuleRequest,
};
use App\Services\{
    ModuleService,
    ListService,
};
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;
use App\Constants\ListDefaults;

class ModuleController extends Controller
{
    public function __construct(protected ModuleService $service) {}

    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string',
            'status' => 'nullable|in:0,1',
        ]);

        $filters = $request->only(['search', 'status']);
        $modules = $this->service->paginate(
            ListDefaults::PER_PAGE, 
            ListDefaults::COLUMNS, 
            $filters
        );
        $statusList = (new ListService())->statusList();
        $sl = ($modules->currentPage() - 1) * $modules->perPage() + 1;

        return view('panel.modules.index', compact('modules', 'statusList', 'sl'));
    }

    public function create()
    {
        $statusList = (new ListService())->statusList();

        return view('panel.modules.create', compact('statusList'));
    }

    public function show($module)
    {
        $module = $this->service->find($module);

        if (!$module) {
            return response()->json(['status' => false, 'message' => 'No record found.']);
        }

        $html = view('panel.modules.detail-modal', compact('module'))->render();

        return response()->json(['status' => true, 'data' => $html]);
    }

    public function store(StoreModuleRequest $request)
    {
        try {
            $module = $this->service->store($request->validated());

            Log::channel('panel')->info('Module created successfully: ', [
                'ip' => $request->ip(),
            ]);

            return redirect()->route('panel.modules.index')
                ->with('success', 'Module created successfully.');
        } catch (ValidationException $e) {
            Log::channel('panel')->warning('Failed to create module: ', [
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
        $module = $this->service->find($id);
        $statusList = (new ListService())->statusList();

        return view('panel.modules.edit', compact('module', 'statusList'));
    }

    public function update(UpdateModuleRequest $request, $id)
    {
        try {
            $this->service->update($id, $request->validated());

            Log::channel('panel')->info('Module updated successfully: ', [
                'ip' => $request->ip(),
            ]);

            return redirect()->route('panel.modules.index')->with('success', 'Module updated successfully.');
        } catch (ValidationException $e) {
            Log::channel('panel')->warning('Failed to update module: ', [
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
            $module = $this->service->find($id);
            $module->delete();

            Log::channel('panel')->info('Module deleted successfully: ', [
                'ip' => request()->ip(),
            ]);

            return redirect()->route('panel.modules.index')->with('success', 'Module deleted successfully.');
        } catch (ValidationException $e) {
            Log::channel('panel')->warning('Failed to delete module: ', [
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
