<div wire:ignore.self class="modal fade" id="editManufacturer" tabindex="-1" aria-labelledby="editManufacturerLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editManufacturerLabel">Edit Manufacturer</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="bg-light rounded h-100 p-4">
                <form>
                    <input type="hidden" name="id" wire-model="ids" />
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="Manufacturer Name" name="name" wire:model.defer="name"/>
                        <label for="floatingInput">Manufacturer Name</label>
                        @error('name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary" wire:click.prevent="update()">Update Manufacturer</button>
                </form>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>