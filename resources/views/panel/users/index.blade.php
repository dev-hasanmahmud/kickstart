@extends('layouts.panel')

@section('title', 'User List')

@push('styles')
    
@endpush

@section('content')
  <div class="theme-card px-3 py-2">
  <div class="d-flex justify-content-between align-items-start flex-wrap">
    <div>
      <h6 class="mb-0">Manage User</h6>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Access Control</a></li>
          <li class="breadcrumb-item"><a href="{{ route('panel.users.index') }}">Users</a></li>
          <li class="breadcrumb-item active" aria-current="page">List</li>
        </ol>
      </nav>
    </div>
    <div class="d-flex gap-2 mt-md-1 mt-lg-1">
      <div class="dropdown">
        <button class="btn btn-sm btn-outline-secondary px-3" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-filter me-1"></i> Filter
        </button>
        <form method="GET" action="{{ route('panel.users.index') }}" class="dropdown-menu p-3" 
          onclick="event.stopPropagation()" style="min-width: 350px;">
          <div class="mb-2">
            <label for="search" class="form-label">Search</label>
            <input type="text" class="form-control form-control-sm" name="search" id="search"value="{{ request('search') }}" placeholder="Search by name, email" data-toggle="tooltip" data-placement="top" title="Search by name, email">
            @error('search')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-2">
            <label for="start_date" class="form-label">Date Range</label>
            <div class="row g-2">
              <div class="col-md-6">
                <input type="date" class="form-control form-control-sm" name="start_date" id="start_date" value="{{ request('start_date') }}"
                  data-toggle="tooltip" data-placement="top" title="Select start date">
                @error('start_date')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="col-md-6">
                <input type="date" class="form-control form-control-sm" name="end_date" id="end_date" value="{{ request('end_date') }}"
                  data-toggle="tooltip" data-placement="top" title="Select end date">
                @error('end_date')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
          </div>
          <div class="mb-2">
            <label for="role_id" class="form-label">Role</label>
            <select class="form-select form-select-sm select2" name="role_id" id="role_id" data-toggle="tooltip" data-placement="top" title="Select Role">
              <option value="" readonly>Select Role</option>
              @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ request('role_id') == $role->id ? 'selected' : '' }}>
                  {{ ucfirst($role->name) }}
                </option>
              @endforeach
            </select>
            @error('role_id')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-2">
            <label for="status" class="form-label">Status</label>
            <select class="form-select form-select-sm select2" name="status" id="status" data-toggle="tooltip" data-placement="top" title="Select Status">
              <option value="" readonly>Select Status</option>
              <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
              <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="d-flex justify-content-end gap-2 mt-2">
            <a href="{{ route('panel.users.index') }}" class="btn btn-sm btn-light">Reset</a>
            <button type="submit" class="btn btn-sm btn-secondary">Filter</button>
          </div>
        </form>
      </div>
      <a href="{{ route('panel.users.create') }}" class="btn btn-sm btn-outline-secondary px-3">
          <i class="fas fa-plus me-1"></i> Create
      </a>
      <div class="dropdown">
        <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-ellipsis-v"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item" href="#">Import</a></li>
          <li><a class="dropdown-item" href="#">Export Excel</a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="table-responsive py-1">
    <table id="usersTable" class="custom-table mb-1">
      <thead class="table-light">
        <tr>
          <th class="text-center">SL.</th>
          <th class="text-center">Full Name</th>
          <th class="text-center">Email Address</th>
          <th class="text-center">Role</th>
          <th class="text-center">Verified</th>
          <th class="text-center">Created At</th>
          <th class="text-center">Status</th>
          <th class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        @if ($users->count())
          @foreach ($users as $user)
            <tr>
              <td class="text-center">{{ $sl + $loop->index }}</td>
              <td class="text-center">{{ $user->name }}</td>
              <td class="text-center">{{ $user->email }}</td>
              <td class="text-center">{{ $user?->role?->name }}</td>
              <td class="text-center">{{ $user->email_verified_at ? 'Yes' : 'No' }}</td>
              <td class="text-center">{{ $user->created_at ? $user->created_at->diffForHumans() : '' }}</td>
              <td class="text-center">{{ ($user->status == 1) ? 'Active' : 'Inactive' }}</td>
              <td class="text-nowrap">
                <div class="d-flex justify-content-center gap-3">
                  <a href="javascript:void(0)" class="text-primary" onclick="seeUserDetail({{ $user->id }})">
                    <i class="fas fa-eye"></i>
                  </a>

                  <a href="{{ route('panel.users.edit', $user->id) }}"
                     class="text-primary"
                     title="Edit">
                    <i class="fas fa-pen-to-square"></i>
                  </a>

                  <a href="javascript:void(0)"
                     onclick="deleteItem({{ $user->id }})"
                     class="text-danger"
                     title="Delete">
                    <i class="fas fa-trash-alt"></i>
                  </a>
                  <form id="delete-{{ $user->id }}"
                        action="{{ route('panel.users.destroy', $user->id) }}"
                        method="POST"
                        style="display: none;">
                      @csrf
                      @method('DELETE')
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        @else
            <tr><td colspan="7" class="text-center">No records found.</td></tr>
        @endif
      </tbody>
    </table>

    <div class="d-flex justify-content-between align-items-center">
        <p class="mb-0 text-muted">
            Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries
        </p>
        {{ $users->links('vendor.pagination.custom') }}
    </div>
  </div>
  </div>
  @include('partials.modal')
@endsection

@push('scripts')
  <script>
    function seeUserDetail(id) {
      let url = "{{ route('panel.users.show', ['user' => ':id']) }}".replace(':id', id);
      showModalContent(url, 'User Details');
    }
  </script>
@endpush
