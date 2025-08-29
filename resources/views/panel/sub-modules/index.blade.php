@extends('layouts.panel')

@section('title', 'Submodule List')

@push('styles')
    
@endpush

@section('content')
  <div class="theme-card px-3 py-2">
  <div class="d-flex justify-content-between align-items-start flex-wrap">
    <div>
      <h6 class="mb-0">Manage Submodule</h6>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Access Control</a></li>
          <li class="breadcrumb-item"><a href="{{ route('panel.sub-modules.index') }}">Submodules</a></li>
          <li class="breadcrumb-item active" aria-current="page">List</li>
        </ol>
      </nav>
    </div>
    <div class="d-flex gap-2 mt-md-1 mt-lg-1">
      <div class="dropdown">
        <button class="btn btn-sm btn-outline-secondary px-3" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-filter me-1"></i> Filter
        </button>
        <form method="GET" action="{{ route('panel.sub-modules.index') }}" class="dropdown-menu p-3" 
          onclick="event.stopPropagation()" style="min-width: 350px;">
          <div class="mb-2">
            <label for="search" class="form-label">Search</label>
            <input type="text" class="form-control form-control-sm" name="search" id="search"value="{{ request('search') }}" placeholder="Search by name" data-toggle="tooltip" data-placement="top" title="Search by name">
            @error('search')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-2">
            <label for="module_id" class="form-label">Module</label>
            <select class="form-select form-select-sm select2" name="module_id" id="module_id">
              <option value="" readonly {{ old('module_id') === null ? 'selected' : '' }}>Select Module</option>
              @foreach($moduleList as $module)
                <option value="{{ $module->id }}" {{ old('module_id') == $module->id ? 'selected' : '' }}>
                    {{ $module->name }}
                </option>
              @endforeach
            </select>
            @error('module_id')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-2">
            <label for="status" class="form-label">Status</label>
            <select class="form-select form-select-sm select2" name="status" id="status" data-toggle="tooltip" data-placement="top" title="Select Status">
              <option value="" readonly>Select Status</option>
              <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
              <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="d-flex justify-content-end gap-2 mt-2">
            <a href="{{ route('panel.modules.index') }}" class="btn btn-sm btn-light">Reset</a>
            <button type="submit" class="btn btn-sm btn-secondary">Filter</button>
          </div>
        </form>
      </div>
      <a href="{{ route('panel.sub-modules.create') }}" class="btn btn-sm btn-outline-secondary px-3">
          <i class="fas fa-plus me-1"></i> Create
      </a>
      <div class="dropdown">
        <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-ellipsis-v"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item" href="#">Import</a></li>
          <li><a class="dropdown-item" href="#">Export Excel</a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="table-responsive py-1">
    <table id="modulesTable" class="custom-table mb-1">
      <thead class="table-light">
        <tr>
          <th class="text-center">SL.</th>
          <th class="text-center">Name</th>
          <th class="text-center">Module</th>
          <th class="text-center">Created At</th>
          <th class="text-center">Status</th>
          <th class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        @if ($subModules->count())
          @foreach ($subModules as $subModule)
            <tr>
              <td class="text-center">{{ $sl + $loop->index }}</td>
              <td class="text-center">{{ $subModule->name }}</td>
              <td class="text-center">{{ $subModule?->module?->name }}</td>
              <td class="text-center">{{ $subModule->created_at ? $subModule->created_at->diffForHumans() : '' }}</td>
              <td class="text-center">{{ \App\Enums\Status::tryFrom($subModule->status)?->label() ?? '' }}</td>
              <td class="text-nowrap">
                <div class="d-flex justify-content-center gap-3">
                  <a href="javascript:void(0)" class="text-primary" onclick="seeSubModuleDetail({{ $subModule->id }})">
                    <i class="fas fa-eye"></i>
                  </a>

                  <a href="{{ route('panel.sub-modules.edit', $subModule->id) }}"
                     class="text-primary"
                     title="Edit">
                    <i class="fas fa-pen-to-square"></i>
                  </a>

                  <a href="javascript:void(0)"
                     onclick="deleteItem({{ $subModule->id }})"
                     class="text-danger"
                     title="Delete">
                    <i class="fas fa-trash-alt"></i>
                  </a>
                  <form id="delete-{{ $subModule->id }}"
                        action="{{ route('panel.sub-modules.destroy', $subModule->id) }}"
                        method="POST"
                        style="display: none;">
                      @csrf
                      @method('DELETE')
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        @else
            <tr><td colspan="7" class="text-center">No records found.</td></tr>
        @endif
      </tbody>
    </table>

    <div class="d-flex justify-content-between align-items-center">
        <p class="mb-0 text-muted">
            Showing {{ $subModules->firstItem() }} to {{ $subModules->lastItem() }} of {{ $subModules->total() }} entries
        </p>
        {{ $subModules->links('vendor.pagination.custom') }}
    </div>
  </div>
  </div>
  @include('partials.modal')
@endsection

@push('scripts')
  <script>
    function seeSubModuleDetail(id) {
      let url = "{{ route('panel.sub-modules.show', ['sub_module' => ':id']) }}".replace(':id', id);
      showModalContent(url, 'Submodule Details');
    }
  </script>
@endpush
