@extends('layouts.panel')

@section('title', 'User Edit')

@push('styles')

@endpush

@section('content')
<div class="card theme-card">
  <div class="card-header">
    <div class="d-flex justify-content-between align-items-start flex-wrap w-100">
      <div>
        <h6 class="mb-0">Edit User</h6>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Access Control</a></li>
            <li class="breadcrumb-item"><a href="{{ route('panel.users.index') }}">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
          </ol>
        </nav>
      </div>
      <div class="d-flex gap-2 mt-md-1 mt-lg-1">
        <a href="{{ route('panel.users.index') }}" class="btn btn-sm btn-outline-secondary px-3">
          <i class="fas fa-arrow-left me-1"></i> Back
        </a>
      </div>
    </div>
  </div>
  <form method="POST" action="{{ route('panel.users.update', $user->id) }}" id="formId">
    @csrf 
    @method('PUT')
    <div class="card-body row g-3 mb-0">
      <div class="col-md-6">
        <label for="name" class="form-label">
          Full Name <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control form-control-sm" name="name" id="name" value="{{ old('name', $user->name) }}" placeholder="Enter full name">
        @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>
      <div class="col-md-6">
        <label for="email" class="form-label">
          Email address <span class="text-danger">*</span>
        </label>
        <input type="email" class="form-control form-control-sm" name="email" id="email" value="{{ old('email', $user->email) }}" placeholder="Enter email address">
        @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>
      <div class="col-md-6">
        <label for="role_id" class="form-label">
          Role <span class="text-danger">*</span>
        </label>
        <select class="form-select form-select-sm select2" name="role_id" id="role_id">
          <option value="">Select Role</option>
          @foreach ($roles as $role)
            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
              {{ $role->name }}
            </option>
          @endforeach
        </select>
        @error('role_id') <div class="text-danger small">{{ $message }}</div> @enderror
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
    $(document).ready(function() {
      $('#formId').validate({
        rules: {
          name: { required: true },
          email: { required: true },
          role_id: { required: true }
        },
        messages: {
          name: 'The name field is required.',
          email: 'The email field is required.',
          role_id: 'The role field is required.'
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
          const loader = getLoader('Updating...');
          $('.submitBtn').html(loader).attr('disabled', true);
          setTimeout(function() {
            form.submit();
          }, 400);
        }
      });
    });
  </script>
@endpush
