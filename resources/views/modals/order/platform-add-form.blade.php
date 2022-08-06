<div wire:ignore.self class="modal fade" id="addPlatform" tabindex="-1" aria-labelledby="addPlatformLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addPlatformLabel">Create New Platform</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="bg-light rounded h-100 p-4">
              <div class="form-floating mb-3">
                  <input type="text" class="form-control" placeholder="Platform Name" name="name" wire:model.defer="platform"/>
                  <label for="floatingInput">Platform Name</label>
                  @error('platform') <span class="text-danger">{{$message}}</span> @enderror
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" wire:click.prevent="store()">Add Platform</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>