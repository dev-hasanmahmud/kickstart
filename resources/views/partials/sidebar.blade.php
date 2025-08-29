<div class="sidebar" id="sidebar">
  <button class="btn btn-close d-md-none" onclick="toggleSidebar()" aria-label="Close"></button>
  <div class="text-center my-1">
    <a href="{{ route('panel.home') }}">
      <img id="themeLogo" src="{{ asset('images/logo1.png') }}" alt="Logo" class="py-2" style="max-width: 120px;" />
    </a>
  </div>
  <ul class="nav flex-column px-1">
    <li class="nav-item {{ Request::routeIs('panel.home') ? 'active' : '' }}">
      <a class="nav-link text-dark" href="{{ route('panel.home') }}">
        <i class="fas fa-home me-2"></i> Home
      </a>
    </li>

    <li class="nav-item has-submenu">
      <a class="nav-link text-dark" href="#">
        <span><i class="fas fa-user-shield me-2"></i> Access Control</span>
        <i class="fas fa-chevron-down toggle-arrow"></i>
      </a>
      <div class="submenu {{ Request::routeIs([
        'panel.users.index', 
        'panel.users.create', 
        'panel.users.edit',
        'panel.roles.index',
        'panel.roles.create', 
        'panel.roles.edit', 
        'panel.permissions.index', 
        'panel.permissions.create', 
        'panel.permissions.edit', 
        'panel.modules.index', 
        'panel.modules.create', 
        'panel.modules.edit', 
        'panel.sub-modules.index', 
        'panel.sub-modules.create', 
        'panel.sub-modules.edit'
        ]) ? 'show' : '' }}">
        <a class="nav-link text-dark {{ Request::routeIs([
          'panel.modules.index', 
          'panel.modules.create', 
          'panel.modules.edit'
          ]) ? 'active' : '' }}" href="{{ route('panel.modules.index') }}">
          <i class="fas fa-angle-right me-2 text-muted"></i> Modules
        </a>
        <a class="nav-link text-dark {{ Request::routeIs([
          'panel.sub-modules.index', 
          'panel.sub-modules.create', 
          'panel.sub-modules.edit'
          ]) ? 'active' : '' }}" href="{{ route('panel.sub-modules.index') }}">
          <i class="fas fa-angle-right me-2 text-muted"></i> Submodules
        </a>
        <a class="nav-link text-dark {{ Request::routeIs([
          'panel.permissions.index', 
          'panel.permissions.create', 
          'panel.permissions.edit'
          ]) ? 'active' : '' }}" href="{{ route('panel.permissions.index') }}">
          <i class="fas fa-angle-right me-2 text-muted"></i> Permissions
        </a>
        <a class="nav-link text-dark {{ Request::routeIs([
          'panel.roles.index', 
          'panel.roles.create', 
          'panel.roles.edit'
          ]) ? 'active' : '' }}" href="{{ route('panel.roles.index') }}">
          <i class="fas fa-angle-right me-2 text-muted"></i> Roles
        </a>
        <a class="nav-link text-dark {{ Request::routeIs([
          'panel.users.index', 
          'panel.users.create', 
          'panel.users.edit'
          ]) ? 'active' : '' }}" href="{{ route('panel.users.index') }}">
          <i class="fas fa-angle-right me-2 text-muted"></i> Users
        </a>
      </div>
    </li>
    <li class="nav-item has-submenu">
      <a class="nav-link text-dark" href="#">
        <span><i class="fas fa-cubes me-2"></i> Menus</span> 
        <i class="fas fa-chevron-down toggle-arrow"></i>
      </a>
      <div class="submenu">
        <a class="nav-link text-dark" href="#">
          <i class="fas fa-angle-right me-2 text-muted"></i> Menu 1
        </a>
        <a class="nav-link text-dark" href="#">
          <i class="fas fa-angle-right me-2 text-muted"></i> Menu 2
        </a>
      </div>
    </li>
  </ul>
</div>
