@extends('layouts.panel')

@section('title', 'Edit Profile')

@push('styles')

@endpush

@section('content')
<div class="card theme-card">
  <div class="card-header">
    <div class="d-flex justify-content-between align-items-start flex-wrap w-100">
      <div>
        <h6 class="mb-0">Edit Profile Information</h6>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="{{ route('panel.users.index') }}">My Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
          </ol>
        </nav>
      </div>
      <div class="d-flex gap-2 mt-md-1 mt-lg-1">
        <a href="{{ route('panel.home') }}" class="btn btn-sm btn-outline-secondary">
          <i class="fas fa-arrow-left me-1"></i> Back to Home
        </a>
      </div>
    </div>
  </div>
  <form action="{{ route('panel.profile.submit') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="card-body g-3 mb-0">
      <div class="row g-2">
        <div class="col-md-6 d-flex align-items-center gap-3">
          <img src="{{ $user->avatar ? asset($user->avatar) : asset('images/profile.png') }}" 
            alt="Avatar" width="56" height="56" class="rounded">
          <input type="hidden" class="form-control form-control-sm" name="avatar_hidden" id="avatar_hidden" value="{{ $user->avatar }}">
          <div class="w-100">
            <label for="avatar" class="form-label mb-1">Avatar</label>
            <input type="file" name="avatar" id="avatar" class="form-control form-control-sm">
            @error('avatar') <div class="text-danger small">{{ $message }}</div> @enderror
          </div>
        </div>
        <div class="col-md-6"></div>
        <div class="col-md-6">
          <label for="name" class="form-label">Full Name</label>
          <input type="text" name="name" id="name" class="form-control form-control-sm"
            value="{{ old('name', $user->name) }}" placeholder="Enter full name" autocomplete="name">
          @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" id="email" class="form-control form-control-sm" placeholder="Enter email address" 
            value="{{ $user->email }}" autocomplete="email" readonly disabled>
        </div>

        <div class="col-12">
          <label for="bio" class="form-label">Bio</label>
          <textarea name="bio" id="bio" rows="3" 
            class="form-control form-control-sm" placeholder="Enter bio">{{ old('bio', $user->bio) }}</textarea>
          @error('bio') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
      </div>
    </div>
    <div class="card-footer text-end d-flex justify-content-end align-items-center" style="gap: 0.5rem;">
      <a href="{{ url()->current() }}" class="btn btn-sm btn-light px-4">Refresh</a>
      <button type="submit" class="btn btn-sm btn-secondary px-4">Update</button>
    </div>
  </form>
</div>

<div class="card theme-card px-3 py-3 my-3">
  <h6 class="mb-3">Delete Account?</h6>
  <p>The action permanently delete account you own and all the associated data. You also won't be able to access shared accounts.</p>
  <p>As well as to inform you about the types of data which will be erased as part of the process.</p>
  <p>Once you "Delete Account", we send you a confirmation email.</p>
  <a href="javascript:void(0)"
    onclick="if(confirm('Are you sure?')) document.getElementById('delete-user-{{ auth()->user()?->id }}').submit();"
    class="btn btn-sm btn-outline-danger px-3"
    title="Delete">
    Delete Account
  </a>
  <form id="delete-user-{{ $user->id }}"
        action="{{ route('panel.users.destroy', auth()->user()?->id) }}"
        method="POST"
        style="display: none;">
      @csrf
      @method('DELETE')
  </form>
</div>
@endsection

@push('scripts')

@endpush
