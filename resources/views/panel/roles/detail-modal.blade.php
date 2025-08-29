<div class="row g-3">
  <div class="col-md-6"><strong>Name:</strong> {{ $role->name }}</div>
  <div class="col-md-6"><strong>Status:</strong> 
    {{ ($role->status == 1) ? 'Active' : 'Inactive' }}
  </div>
  <div class="col-md-6"><strong>Created At:</strong> 
    {{ $role->created_at ? $role->created_at->diffForHumans() : '' }}
  </div>
  <div class="col-md-6"><strong>Last Updated At:</strong> 
    {{ $role->updated_at ? $role->updated_at->diffForHumans() : '' }}
  </div>
</div>
