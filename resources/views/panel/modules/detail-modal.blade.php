<div class="row g-3">
  <div class="col-md-6"><strong>Name:</strong> {{ $module->name }}</div>
  <div class="col-md-6"><strong>Status:</strong> 
    {{ ($module->status == 1) ? 'Active' : 'Inactive' }}
  </div>
  <div class="col-md-6"><strong>Created At:</strong> 
    {{ $module->created_at ? $module->created_at->diffForHumans() : '' }}
  </div>
  <div class="col-md-6"><strong>Last Updated At:</strong> 
    {{ $module->updated_at ? $module->updated_at->diffForHumans() : '' }}
  </div>
</div>
