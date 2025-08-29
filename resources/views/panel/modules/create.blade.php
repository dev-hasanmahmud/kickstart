@extends('layouts.panel')

@section('title', 'Module Create')

@push('styles')

@endpush

@section('content')
<div class="card theme-card">
  <div class="card-header">
    <div class="d-flex justify-content-between align-items-start flex-wrap w-100">
      <div>
        <h6 class="mb-0">Create Module</h6>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Access Control</a></li>
            <li class="breadcrumb-item"><a href="{{ route('panel.modules.index') }}">Modules</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
          </ol>
        </nav>
      </div>
      <div class="d-flex gap-2 mt-md-1 mt-lg-1">
        <a href="{{ route('panel.modules.index') }}" class="btn btn-sm btn-outline-secondary px-3">
          <i class="fas fa-arrow-left me-1"></i> Back
        </a>
      </div>
    </div>
  </div>
  <form method="POST" action="{{ route('panel.modules.store') }}" id="formId">
    @csrf
    <div class="card-body row g-3 mb-0">
      <div class="col-md-6">
        <label for="name" class="form-label">
          Name <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control form-control-sm" name="name" id="name" value="{{ old('name') }}" placeholder="Enter name" autocomplete="name" required autofocus>
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
