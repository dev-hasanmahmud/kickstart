<div class="topbar">
  <button class="toggle-btn" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
  <div class="d-flex align-items-center">
    <!-- Theme -->
    <span class="text-dark cursor-pointer me-3 d-none" id="themeToggle">
      <i class="fas fa-sun text-dark" id="themeIcon"></i>
    </span>
    <!-- Profile -->
    <div class="dropdown">
      <a href="#" id="profileDropdown" data-bs-toggle="dropdown" class="d-flex align-items-center text-dark">
        <img src="{{ auth()->user()?->avatar ? asset(auth()->user()?->avatar) : asset('images/profile.png') }}" 
            alt="Avatar" width="30" height="30" class="rounded-circle me-1">
      </a>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
        <li>
          <a class="dropdown-item {{ Request::routeIs('panel.profile') ? 'active' : '' }}" href="{{ route('panel.profile') }}">
            <i class="fas fa-user-circle me-2"></i> My Profile
          </a>
        </li>
        <li><hr class="dropdown-divider"></li>
        <li>
            <a class="dropdown-item text-dark" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
      </ul>
    </div>
  </div>
</div>
