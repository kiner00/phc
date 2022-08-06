<div wire:ignore.self class="modal fade" id="addProductCategory" tabindex="-1" aria-labelledby="addProductCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addProductCategoryLabel">Create New Product Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="bg-light rounded h-100 p-4">
                <form>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="Product Category Name" name="name" wire:model.defer="name"/>
                        <label for="floatingInput">Product Category Name</label>
                        @error('name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary" wire:click.prevent="store()">Add Product Category</button>
                </form>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>