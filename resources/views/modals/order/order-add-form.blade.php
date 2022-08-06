<div wire:ignore.self class="modal fade" id="addOrder" tabindex="-1" aria-labelledby="addOrderLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addOrderLabel">Create New Order</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="bg-light rounded h-100 p-4">
              <div class="form-floating mb-3">
                <select class="form-select" aria-label="Platform" name="platform_id" wire:model="platform_id">
                  <option selected="">Select Platform</option>
                  @if($platforms)
                    @foreach($platforms as $platform)
                      <option value="{{$platform->id}}">{{$platform->platform}}</option>
                    @endforeach
                  @endif
                </select>
                <label for="floatingSelect">Platform</label>
                @error('platform_id') <span class="text-danger">{{$message}}</span> @enderror
              </div>
              <div class="form-floating mb-3">
                  <input type="text" class="form-control" placeholder="Order Number" name="order_number" wire:model.defer="order_number"/>
                  <label for="floatingInput">Order Number</label>
                  @error('order_number') <span class="text-danger">{{$message}}</span> @enderror
              </div>
              <div class="form-floating mb-3">
                  <input type="text" class="form-control" placeholder="Full Name" name="full_name" wire:model.defer="full_name"/>
                  <label for="floatingInput">Full Name</label>
                  @error('full_name') <span class="text-danger">{{$message}}</span> @enderror
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" placeholder="Complete Address" name="complete_address" wire:model.defer="complete_address"/>
                <label for="floatingInput">Complete Address</label>
                @error('complete_address') <span class="text-danger">{{$message}}</span> @enderror
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" placeholder="Mobile Number" name="mobile_number" wire:model.defer="mobile_number"/>
                <label for="floatingInput">Mobile Number</label>
                @error('mobile_number') <span class="text-danger">{{$message}}</span> @enderror
              </div>
              <div>
                @foreach($productInputs as $key => $productInput)
                  <div class="form-floating row g-3">
                    <div class="col">
                      <select class="form-select form-select-lg mb-3" aria-label="Products" wire:model.lazy="product_id.{{$key}}" name="product_id.{{ $key }}">
                        <option selected="">Product</option>
                        @foreach($modalAddPoProducts as $key1 => $modalAddPoProduct)
                          <option value="{{$modalAddPoProduct->id}}">{{$modalAddPoProduct->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col">
                      <input type="number" class="form-control form-control-lg mb-3" placeholder="Qty" name="product_quantity.{{ $key }}" wire:model.lazy="product_quantity.{{ $key }}"/>
                    </div>
                    <div class="col">
                      <input type="number" class="form-control form-control-lg mb-3" placeholder="Price" name="product_price.{{ $key }}" wire:model.lazy="product_price.{{ $key }}"/>
                    </div>
                    <div class="col">
                      <button class="btn btn-danger btn-lg" wire:click.prevent="deleteProductModal({{$key}})">remove</button>
                    </div>
                  </div>
                @endforeach
                @error('product_id') <span class="text-danger">{{$message}}</span> @enderror
                @error('product_quantity') <span class="text-danger">{{$message}}</span> @enderror
                @error('product_price') <span class="text-danger">{{$message}}</span> @enderror
              </div>
              <div class="form-floating mb-3">
                <button type="button" class="btn btn-primary" wire:click.prevent="addProductModal({{$productCounts}})">Add Product</button>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" wire:click.prevent="store()">Add Order</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>