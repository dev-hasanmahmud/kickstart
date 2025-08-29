@extends('layouts.panel')

@section('title', 'Role Create')

@push('styles')

@endpush

@section('content')
<div class="card theme-card">
  <div class="card-header">
    <div class="d-flex justify-content-between align-items-start flex-wrap w-100">
      <div>
        <h6 class="mb-0">Create Role</h6>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Access Control</a></li>
            <li class="breadcrumb-item"><a href="{{ route('panel.roles.index') }}">Roles</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
          </ol>
        </nav>
      </div>
      <div class="d-flex gap-2 mt-md-1 mt-lg-1">
        <a href="{{ route('panel.roles.index') }}" class="btn btn-sm btn-outline-secondary px-3">
          <i class="fas fa-arrow-left me-1"></i> Back
        </a>
      </div>
    </div>
  </div>
  <form method="POST" action="{{ route('panel.roles.store') }}" id="formId">
    @csrf
    <div class="card-body row g-3 mb-0">
      <div class="col-md-6">
        <label for="name" class="form-label">
          Name <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control form-control-sm" name="name" id="name" placeholder="Enter name" autocomplete="name" required>
        @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>
      <div class="col-md-6">
        <label for="status" class="form-label">Status</label>
        <select class="form-select form-select-sm select2" name="status" id="status">
          <option value="" readonly {{ old('status') === null ? 'selected' : '' }}>Select Status</option>
          @foreach($statusList as $value => $label)
            <option value="{{ $value }}" {{ old('status') == $value ? 'selected' : '' }}>
                {{ $label }}
            </option>
          @endforeach
        </select>
        @error('status') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>
      <div class="col-md-12">
        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" id="checkAllGlobal">
          <label class="form-check-label fw-bold" for="checkAllGlobal">Assign all Permissions</label>
        </div>
        <div class="table-responsive">
          <table class="custom-table">
            <thead class="table-light">
              <tr>
                <th class="text-center" width="20%">Module</th>
                <th class="text-center" width="25%">Sub Module</th>
                <th class="text-center">Permissions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($modules as $module)
                @foreach($module->subModules as $subModule)
                  <tr>
                    @if ($loop->first)
                      <td rowspan="{{ $module->subModules->count() }}" class="align-middle fw-bold">{{ $module->name }}</td>
                    @endif
                    <td>
                      <div class="form-check">
                        <input
                          type="checkbox"
                          class="form-check-input check-all-submodule"
                          id="subModuleCheckAll-{{ $subModule->id }}"
                          data-submodule-id="{{ $subModule->id }}"
                        >
                        <label class="form-check-label fw-semibold" for="subModuleCheckAll-{{ $subModule->id }}">
                          {{ $subModule->name ? 'Assign ' . $subModule->name . ' All' : '' }}
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex flex-wrap gap-3">
                        @foreach($subModule->permissions as $permission)
                          <div class="form-check">
                            <input
                              type="checkbox"
                              class="form-check-input permission-checkbox submodule-{{ $subModule->id }}"
                              name="permissions[]"
                              id="permission-{{ $permission->id }}"
                              value="{{ $permission->id }}"
                              @checked(is_array(old('permissions')) && in_array($permission->id, old('permissions')))
                            >
                            <label class="form-check-label" for="permission-{{ $permission->id }}">
                              {{ $permission->label }}
                            </label>
                          </div>
                        @endforeach
                      </div>
                    </td>
                  </tr>
                @endforeach
              @endforeach
            </tbody>
          </table>
        </div>

      </div>
    </div>
    <div class="card-footer text-end d-flex justify-content-end align-items-center" style="gap: 0.5rem;">
      <button type="reset" class="btn btn-sm btn-light px-4">Reset</button>
      <button type="submit" class="btn btn-sm btn-secondary px-4 submitBtn">Save</button>
    </div>
  </form>
</div>
@endsection

@push('scripts')
<script>
  document.getElementById('checkAllGlobal').addEventListener('change', function () {
    const isChecked = this.checked;
    document.querySelectorAll('.permission-checkbox, .check-all-submodule').forEach(cb => cb.checked = isChecked);
  });

  document.querySelectorAll('.check-all-submodule').forEach(checkAll => {
    checkAll.addEventListener('change', function () {
      const submoduleId = this.dataset.submoduleId;
      const checkboxes = document.querySelectorAll(`.submodule-${submoduleId}`);
      checkboxes.forEach(cb => cb.checked = this.checked);
    });
  });

  $(document).ready(function() {
      $('#formId').validate({
        rules: {
          name: { required: true }
        },
        messages: {
          name: 'The name field is required.',
        },
        errorPlacement: function (error, element) {
          if (element.hasClass('select2-hidden-accessible')) {
            error.insertAfter(element.next('.select2-container'));
          } else {
            error.insertAfter(element);
          }
        },
        highlight: function (element) {
          if ($(element).hasClass('select2-hidden-accessible')) {
            $(element).next('.select2-container').find('.select2-selection').addClass('error');
          } else {
            $(element).addClass('error');
          }
        },
        unhighlight: function (element) {
          if ($(element).hasClass('select2-hidden-accessible')) {
            $(element).next('.select2-container').find('.select2-selection').removeClass('error');
          } else {
            $(element).removeClass('error');
          }
        },
        submitHandler: function(form) {
          const loader = getLoader('Saving...');
          $('.submitBtn').html(loader).attr('disabled', true);
          setTimeout(function() {
            form.submit();
          }, 400);
        }
      });
    });
</script>
@endpush
