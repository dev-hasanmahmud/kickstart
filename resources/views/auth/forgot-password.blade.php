@extends('layouts.auth')

@section('title', 'Forgot Password')

@push('styles')
    
@endpush

@section('content')
  <div id="page-content">
     <h6 class="mb-3 text-center">Forgot Your Password?</h6>

      @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('status') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <form method="POST" action="{{ route('password.email') }}">
          @csrf

          <div class="mb-2">
              <label for="email">Email address</label>
              <input type="email" name="email" class="form-control" placeholder="Enter email address" required autofocus>
              @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
          </div>

          <button type="submit" class="btn btn-primary w-100">Send Password Reset Link</button>

          <div class="text-center mt-2">
            Remembered? <a href="{{ route('login') }}">Login</a>
            <p class="text-muted mt-2">Didn’t get the email? Just re-enter your email above and submit again to resend the link.</p>
          </div>
      </form>
  </div>
@endsection

@push('scripts')

@endpush