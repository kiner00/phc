<div wire:ignore.self class="modal fade" id="addManualStock" tabindex="-1" aria-labelledby="addManualStockLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addManualStockLabel">Add Stock</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="bg-light rounded h-100 p-4">
                <form>
                    <div class="form-floating mb-3">
                      <select class="form-select" aria-label="Product" name="product_id" wire:model="product_id">
                        <option selected="">Select Product</option>
                        @if($products)
                          @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                          @endforeach
                        @endif
                      </select>
                      <label for="floatingSelect">Product</label>
                      @error('product_id') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-floating mb-3">
                      <select class="form-select" aria-label="Operation" name="operation" wire:model="operation">
                        <option selected="">Select Operation</option>
                        <option value="add">Add</option>
                        <option value="subtract">Subtract</option>
                      </select>
                      <label for="floatingSelect">Product</label>
                      @error('product_id') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-floating mb-3">
                      <input type="number" class="form-control" placeholder="Quantity" name="quantity" wire:model.defer="quantity"/>
                      <label for="floatingInput">Quantity</label>
                      @error('quantity') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" placeholder="Added By" value="{{Auth::user()->name}}" disabled/>
                      <label for="floatingInput">Added By</label>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" wire:click.prevent="store()">Add/Substract Products</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>