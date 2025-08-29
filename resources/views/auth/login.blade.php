@extends('layouts.auth')

@section('title', 'Login')

@push('styles')
    
@endpush

@section('content')
  <div id="page-content">

    <h6 class="mb-3 text-center">Login to Your Account</h6>

    @if(session('message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    
    @if (session('status'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    
    <form method="POST" action="{{ route('login.submit') }}">
      @csrf

      <div class="mb-2">
        <label for="email">Email address</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email address" autocomplete="email" required autofocus>
        @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <div class="mb-2">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="••••••••" autocomplete="current-password" required>
        @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <div class="d-flex justify-content-between align-items-center mb-2">
        <div class="form-check">
          <input type="checkbox" class="form-check-input" name="remember_me" id="remember_me">
          <label class="form-check-label" for="remember_me">Remember me</label>
          @error('remember_me') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <a href="{{ route('password.request') }}">Forgot Password?</a>
      </div>

      <button type="submit" class="btn btn-primary w-100 mb-2">Login</button>
      <div class="text-center text-muted small">Or continue with</div>
      
      <div class="d-grid gap-1 mt-1">
        <button type="button" class="btn btn-outline-dark">
          <i class="fab fa-google me-2"></i>Continue with Google
        </button>
        <button type="button" class="btn btn-outline-primary">
          <i class="fab fa-facebook me-2"></i>Continue with Facebook
        </button>
        <button type="button" class="btn btn-outline-secondary">
          <i class="fab fa-apple me-2"></i>Continue with Apple
        </button>
      </div>

      <div class="text-center mt-2">
        Don't have an account? Register as an 
        <a href="{{ route('register', ['as' => 'author']) }}">Author</a> or 
        <a href="{{ route('register', ['as' => 'editor']) }}">Editor</a>.
      </div>
    </form>
  </div>
@endsection

@push('scripts')

@endpush
