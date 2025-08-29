<div class="row g-3">
  <div class="col-md-6"><strong>Module:</strong> {{ $subModule?->module?->name }}</div>
  <div class="col-md-6"><strong>Name:</strong> {{ $subModule->name }}</div>
  <div class="col-md-6"><strong>Status:</strong> 
    {{ ($subModule->status == 1) ? 'Active' : 'Inactive' }}
  </div>
  <div class="col-md-6"><strong>Created At:</strong> 
    {{ $subModule->created_at ? $subModule->created_at->diffForHumans() : '' }}
  </div>
  <div class="col-md-6"><strong>Last Updated At:</strong> 
    {{ $subModule->updated_at ? $subModule->updated_at->diffForHumans() : '' }}
  </div>
</div>
