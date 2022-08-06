<div wire:ignore.self class="modal fade" id="editProduct" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProductLabel">Edit Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="bg-light rounded h-100 p-4">
                <form>
                  <input type="hidden" name="id" wire-model="ids" />
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Product Name" name="name" wire:model.defer="name"/>
                    <label for="floatingInput">Product Name</label>
                    @error('name') <span class="text-danger">{{$message}}</span> @enderror
                  </div>
                  <div class="form-floating mb-3">
                    <select class="form-select" aria-label="Select Manufacturer" name="manufacturer_id" wire:model="manufacturer_id">
                        <option selected="">Select Manufacturer</option>
                        @if($manufacturers)
                          @foreach($manufacturers as $manuf)
                            <option value="{{$manuf->id}}" >{{$manuf->name}}</option>
                          @endforeach
                        @endif
                    </select>
                    <label for="floatingSelect">Select Manufacturer</label>
                  </div>
                  <div class="form-floating mb-3">
                    <select class="form-select" aria-label="Select Product Category" name="product_category_id" wire:model="product_category_id">
                        <option selected="">Select Product Category</option>
                        @if($productCategories)
                          @foreach($productCategories as $productCategory)
                            <option value="{{$productCategory->id}}" >{{$productCategory->name}}</option>
                          @endforeach
                        @endif
                    </select>
                    <label for="floatingSelect">Select Product Category</label>
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="base-price-symbol">₱</span>
                    <input type="number" class="form-control" placeholder="Base Price" aria-label="Base Price" aria-describedby="base-price-symbol" wire:model.defer="base_price" name="base_price">
                    @error('base_price') <span class="text-danger">{{$message}}</span> @enderror
                  </div>
                  <button type="submit" class="btn btn-primary" wire:click.prevent="update()">Update Product</button>
                </form>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>