@extends('layouts.auth')

@section('title', 'Register')

@push('styles')
    
@endpush

@section('content')
  <div id="page-content">
    <h6 class="mb-3 text-center">Create Free Account</h6>

    @if(session('message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    
    <form method="POST" action="{{ route('register.submit') }}">
      @csrf

      <div class="mb-2">
        <label for="name">Full Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Enter full name" autocomplete="name" required autofocus>
        @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <div class="mb-2">
        <label for="email">Email address</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Enter email address" autocomplete="email" required>
        @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <div class="mb-2">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" autocomplete="new-password" required>
        @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <div class="mb-2">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="••••••••" autocomplete="new-password" required>
        @error('password_confirmation') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <div class="mb-2">
        <div class="form-check">
          <input type="checkbox" class="form-check-input" name="i_agree" id="i_agree" value="1" {{ old('i_agree') ? 'checked' : '' }} required>
          <label class="form-check-label" for="i_agree">
            I agree to the 
            <a href="{{ route('web.terms.conditions') }}" target="_blank">Terms</a>, 
            <a href="{{ route('web.privacy.policy') }}" target="_blank">Privacy Policy</a> and 
            <a href="{{ route('web.cookies.policy') }}" target="_blank">Cookies Policy</a>.
          </label><br>
          @error('i_agree') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
      </div>

      <input type="hidden" name="as" value="{{ $role }}">
      <button type="submit" class="btn btn-primary w-100">Register</button>
      <div class="text-center mt-2">
        Already have an account? <a href="{{ route('login') }}">Login</a>
      </div>
    </form>
  </div>
@endsection

@push('scripts')

@endpush
