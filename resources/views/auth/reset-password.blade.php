@extends('layouts.auth')

@section('title', 'Reset Password')

@push('styles')
    
@endpush

@section('content')
  <div id="page-content">
    <h6 class="mb-3 text-center">Reset New Password</h6>

    @if (session('status'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <div class="mb-2">
            <label for="password">New Password</label>
            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-2">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
            @error('password_confirmation') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">Reset Password</button>

        <div class="text-center mt-2">
          Remembered? <a href="{{ route('login') }}">Login</a>
        </div>
    </form>
  </div>
@endsection

@push('scripts')

@endpush