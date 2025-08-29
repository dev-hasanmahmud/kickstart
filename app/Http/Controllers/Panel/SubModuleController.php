<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Panel\{
    StoreSubModuleRequest,
    UpdateSubModuleRequest,
};
use App\Services\{
    SubModuleService,
    ListService,
};
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;
use App\Constants\ListDefaults;

class SubModuleController extends Controller
{
    public function __construct(protected SubModuleService $service) {}

    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string',
            'module_id' => 'nullable|integer',
            'status' => 'nullable|in:0,1',
        ]);

        $filters = $request->only(['search', 'module_id', 'status']);
        $subModules = $this->service->paginate(
            ListDefaults::PER_PAGE, 
            ListDefaults::COLUMNS, 
            $filters
        );
        $moduleList = (new ListService())->moduleList();
        $statusList = (new ListService())->statusList();
        $sl = ($subModules->currentPage() - 1) * $subModules->perPage() + 1;

        return view('panel.sub-modules.index', compact('subModules', 'moduleList', 'statusList', 'sl'));
    }

    public function create()
    {
        $moduleList = (new ListService())->moduleList();
        $statusList = (new ListService())->statusList();

        return view('panel.sub-modules.create', compact('moduleList', 'statusList'));
    }

    public function show($subModule)
    {
        $subModule = $this->service->find($subModule);

        if (!$subModule) {
            return response()->json(['status' => false, 'message' => 'No record found.']);
        }

        $html = view('panel.sub-modules.detail-modal', compact('subModule'))->render();

        return response()->json(['status' => true, 'data' => $html]);
    }

    public function store(StoreSubModuleRequest $request)
    {
        try {
            $subModule = $this->service->store($request->validated());

            Log::channel('panel')->info('Sub Module created successfully: ', [
                'ip' => $request->ip(),
            ]);

            return redirect()->route('panel.sub-modules.index')
                ->with('success', 'Sub Module created successfully.');
        } catch (ValidationException $e) {
            Log::channel('panel')->warning('Failed to create sub module: ', [
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
        $subModule = $this->service->find($id);
        $moduleList = (new ListService())->moduleList();
        $statusList = (new ListService())->statusList();

        return view('panel.sub-modules.edit', compact('subModule', 'moduleList', 'statusList'));
    }

    public function update(UpdateSubModuleRequest $request, $id)
    {
        try {
            $this->service->update($id, $request->validated());

            Log::channel('panel')->info('Sub Module updated successfully: ', [
                'ip' => $request->ip(),
            ]);

            return redirect()->route('panel.sub-modules.index')->with('success', 'Sub Module updated successfully.');
        } catch (ValidationException $e) {
            Log::channel('panel')->warning('Failed to update sub module: ', [
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
            $subModule = $this->service->find($id);
            $subModule->delete();

            Log::channel('panel')->info('Sub Module deleted successfully: ', [
                'ip' => request()->ip(),
            ]);

            return redirect()->route('panel.sub-modules.index')->with('success', 'Sub Module deleted successfully.');
        } catch (ValidationException $e) {
            Log::channel('panel')->warning('Failed to delete sub module: ', [
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
