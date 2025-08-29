@extends('layouts.panel')

@section('title', 'Home')

@push('styles')
    
@endpush

@section('content')
  @if(session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('message') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  <div class="theme-card px-3 py-2">
    <h6>Welcome to admin panel!</h6>
  </div>
@endsection

@push('scripts')

@endpush
