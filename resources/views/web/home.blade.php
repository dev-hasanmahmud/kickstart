@extends('layouts.web')

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
  
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul class="mb-0">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  @auth
    <h6>Welcome to website home, <br/> {{ auth()->user() }}.</h6>
    For <a href="{{ route('panel.home') }}">Back Home</a> click here!
    <a class="dropdown-item text-dark" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt me-2"></i> Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
  @endauth

  @guest
    <h6>Welcome to website home, guest.</h6>
    For <a href="{{ route('login') }}">Login</a> click here! <br>
    Don't have an account? Register as an 
    <a href="{{ route('register', ['as' => 'author']) }}">Author</a> or 
    <a href="{{ route('register', ['as' => 'editor']) }}">Editor</a>.
  @endguest
@endsection

@push('scripts')

@endpush
