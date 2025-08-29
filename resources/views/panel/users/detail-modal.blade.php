<div class="row g-3">
  <div class="col-md-6 mt-1">
    <img src="{{ $user->avatar ? asset($user->avatar) : asset('images/profile.png') }}" 
    alt="Avatar" width="35" height="35" class="rounded">
  </div>
  <div class="col-md-6"><strong>Full Name:</strong> {{ $user->name }}</div>
  <div class="col-md-6"><strong>Email Address:</strong> {{ $user->email }}</div>
  <div class="col-md-6"><strong>Email Verified At:</strong> 
    {{ $user->email_verified_at ? $user->email_verified_at->diffForHumans() : '' }}
  </div>
  <div class="col-md-6"><strong>Role:</strong> {{ ucfirst($user?->role?->name) }}</div>
  <div class="col-md-6"><strong>Agreement:</strong> 
    {{ ($user->i_agree == 1) ? 'Accepted' : 'Not accept' }}
  </div>
  <div class="col-md-6"><strong>Status:</strong> 
    {{ ($user->status == 1) ? 'Active' : 'Inactive' }}
  </div>
  <div class="col-md-6"><strong>Created At:</strong> 
    {{ $user->created_at ? $user->created_at->diffForHumans() : '' }}
  </div>
  <div class="col-md-6"><strong>Last Updated At:</strong> 
    {{ $user->updated_at ? $user->updated_at->diffForHumans() : '' }}
  </div>
  <div class="col-md-6"><strong>Bio:</strong> {{ $user->bio }}</div>
</div>
