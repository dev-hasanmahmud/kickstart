@extends('layouts.auth')

@section('title', 'Verify')

@push('styles')
    
@endpush

@section('content')
  <div id="page-content">
    <!-- Verify Email -->
    <h6 class="mb-3 text-center">Thank you for Register with Us!</h6>
    <p>A verification link has been sent to your email. Please check your inbox.</p>
    <p>Note: If you do not receive the email in few minutes:</p>
    <ul>
      <li>Check spam mail carefully.</li>
      <li>Check your typed email correctly.</li>
      <li>If you can't resolve the issue, please contact- support@Laravel.com</li>
    </ul>
    <div class="text-center">
      <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left me-1"></i> Back to Login
      </a>
    </div>
  </div>
@endsection

@push('scripts')

@endpush
