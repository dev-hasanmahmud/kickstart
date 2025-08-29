<div class="row g-3">
  <div class="col-md-6"><strong>Module:</strong> {{ $permission?->module?->name }}</div>
  <div class="col-md-6"><strong>Sub Module:</strong> {{ $permission?->subModule?->name }}</div>
  <div class="col-md-6"><strong>Label:</strong> {{ $permission->label }}</div>
  <div class="col-md-6"><strong>Name:</strong> {{ $permission->name }}</div>
  <div class="col-md-6"><strong>Is Core:</strong> 
    {{ ($permission->is_core == 1) ? 'Yes' : 'No' }}
  </div>
  <div class="col-md-6"><strong>Status:</strong> 
    {{ ($permission->status == 1) ? 'Active' : 'Inactive' }}
  </div>
  <div class="col-md-6"><strong>Created At:</strong> 
    {{ $permission->created_at ? $permission->created_at->diffForHumans() : '' }}
  </div>
  <div class="col-md-6"><strong>Last Updated At:</strong> 
    {{ $permission->updated_at ? $permission->updated_at->diffForHumans() : '' }}
  </div>
</div>
