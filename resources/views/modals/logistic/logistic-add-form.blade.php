<div wire:ignore.self class="modal fade" id="addDelivered" tabindex="-1" aria-labelledby="addDeliveredLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addDeliveredLabel">Add Delivered Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="bg-light rounded h-100 p-4">
                <form>
                    <div class="form-floating mb-3">
                      <select class="form-select" aria-label="Purchase Order" name="purchase_order_id" wire:model="purchase_order_id">
                        <option selected="">Select Purchase Order</option>
                        @if($purchaseOrdersModal)
                          @foreach($purchaseOrdersModal as $purchaseOrderModal)
                            <option value="{{$purchaseOrderModal->id}}">{{$purchaseOrderModal->purchase_order_number}}</option>
                          @endforeach
                        @endif
                      </select>
                      <label for="floatingSelect">Purchase Order</label>
                      @error('purchase_order_id') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-floating mb-3">
                      <select class="form-select" aria-label="Product" name="product_id" wire:model="product_id">
                        <option selected="">Select Product</option>
                        @if($purchaseOrderProducts)
                          @foreach($purchaseOrderProducts as $purchaseOrderProduct)
                            <option value="{{$purchaseOrderProduct->product_id}}">{{$purchaseOrderProduct->product->name}}</option>
                          @endforeach
                        @endif
                      </select>
                      <label for="floatingSelect">Product</label>
                      @error('product_id') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <p>
                      Remaining: <mark>{{$purchaseOrderProductRemaining ? $purchaseOrderProductRemaining->remaining : 0}} </mark>
                    </p>
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" placeholder="Quantity" name="quantity" wire:model.defer="quantity"/>
                      <label for="floatingInput">Quantity</label>
                      @error('quantity') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" wire:click.prevent="store()">Add Delivered Products</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>