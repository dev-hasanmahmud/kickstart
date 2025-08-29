@extends('layouts.panel')

@section('title', 'Permission Edit')

@push('styles')

@endpush

@section('content')
<div class="card theme-card">
  <div class="card-header">
    <div class="d-flex justify-content-between align-items-start flex-wrap w-100">
      <div>
        <h6 class="mb-0">Edit Permission</h6>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Access Control</a></li>
            <li class="breadcrumb-item"><a href="{{ route('panel.permissions.index') }}">Permissions</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
          </ol>
        </nav>
      </div>
      <div class="d-flex gap-2 mt-md-1 mt-lg-1">
        <a href="{{ route('panel.permissions.index') }}" class="btn btn-sm btn-outline-secondary px-3">
          <i class="fas fa-arrow-left me-1"></i> Back
        </a>
      </div>
    </div>
  </div>
  <form method="POST" action="{{ route('panel.permissions.update', $permission->id) }}" id="formId">
    @csrf 
    @method('PUT')
    <div class="card-body row g-3 mb-0">
      <div class="col-md-6">
        <label for="module_id" class="form-label">
          Module <span class="text-danger">*</span>
        </label>
        <select class="form-select form-select-sm select2" name="module_id" id="module_id">
          <option value="" readonly {{ old('module_id', $permission->module_id) === null ? 'selected' : '' }}>Select Module</option>
          @foreach($moduleList as $module)
            <option value="{{ $module->id }}" {{ old('module_id', $permission->module_id) == $module->id ? 'selected' : '' }}>
                {{ $module->name }}
            </option>
          @endforeach
        </select>
        @error('module_id') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>
      <div class="col-md-6">
        <label for="sub_module_id" class="form-label">Sub Module
          Sub Module <span class="text-danger">*</span>
        </label>
        <select class="form-select form-select-sm select2" name="sub_module_id" id="sub_module_id">
          <option value="" readonly {{ old('sub_module_id', $permission->sub_module_id) === null ? 'selected' : '' }}>Select Sub Module</option>
          @foreach($subModuleList as $sModule)
            <option value="{{ $sModule->id }}" {{ old('sub_module_id', $permission->sub_module_id) == $sModule->id ? 'selected' : '' }}>
                {{ $sModule->name }}
            </option>
          @endforeach
        </select>
        @error('sub_module_id') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>
      <div class="col-md-6">
        <label for="label" class="form-label">
          Label <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control form-control-sm" name="label" id="label" value="{{ old('label', $permission->label) }}" placeholder="Enter label" autocomplete="off">
        @error('label')
          <span class="text-danger small"><strong>{{ $message }}</strong></span>
        @enderror
      </div>
      <div class="col-md-6">
        <label for="name" class="form-label">
          Name <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control form-control-sm" name="name" id="name" value="{{ old('name', $permission->name) }}" placeholder="Enter name" autocomplete="off">
        @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>
      <div class="col-md-6">
        <label for="is_core" class="form-label">Is Core</label>
        <select class="form-select form-select-sm select2" name="is_core" id="is_core">
          <option value="" readonly {{ old('is_core', $permission->is_core) === null ? 'selected' : '' }}>Select Is Core</option>
            <option value="0" {{ old('is_core', $permission->is_core) == 0 ? 'selected' : '' }}>No</option>
            <option value="1" {{ old('is_core', $permission->is_core) == 1 ? 'selected' : '' }}>Yes</option>
        </select>
        @error('is_core') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>
      <div class="col-md-6">
        <label for="status" class="form-label">Status</label>
        <select class="form-select form-select-sm select2" name="status" id="status">
          <option value="" readonly {{ old('status', $permission->status) === null ? 'selected' : '' }}>Select Status</option>
          @foreach($statusList as $value => $label)
            <option value="{{ $value }}" {{ old('status', $permission->status) == $value ? 'selected' : '' }}>
                {{ $label }}
            </option>
          @endforeach
        </select>
        @error('status') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>
    </div>
    <div class="card-footer text-end d-flex justify-content-end align-items-center" style="gap: 0.5rem;">
      <a href="{{ url()->current() }}" class="btn btn-sm btn-light px-4">Refresh</a>
      <button type="submit" class="btn btn-sm btn-secondary px-4 submitBtn">Update</button>
    </div>
  </form>
</div>
@endsection

@push('scripts')
  <script>
    $(document).ready(function () {
      $('#formId').validate({
        rules: {
          module_id: { required: true },
          sub_module_id: { required: true },
          label: { required: true },
          name: { required: true }
        },
        messages: {
          module_id: 'The module field is required.',
          sub_module_id: 'The sub module field is required.',
          label: 'The label field is required.',
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
        submitHandler: function (form) {
          const loader = getLoader('Updating...');
          $('.submitBtn').html(loader).attr('disabled', true);
          setTimeout(function () {
            form.submit();
          }, 400);
        }
      });
    });
  </script>
@endpush
