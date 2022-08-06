<div wire:ignore.self class="modal fade" id="editPo" tabindex="-1" aria-labelledby="editPoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPoLabel">Create New Purchase Order</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="bg-light rounded h-100 p-4">
                <div class="form-floating mb-3">
                    <input type="hidden" name="id" wire-model="ids" />
                    <input type="text" class="form-control" placeholder="Purchase Order #" name="purchase_order_number" wire:model="purchase_order_number"/>
                    <label for="floatingInput">Purchase Order Number</label>
                    @error('purchase_order_number') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class="form-floating mb-3">
                  <select class="form-select" aria-label="Manufacturer" name="manufacturer_id" wire:model="manufacturer_id">
                    <option selected="">Open this select Manufacturer</option>
                    @if($modalAddPoManufacturers)
                      @foreach($modalAddPoManufacturers as $modalAddPoManufacturer)
                        <option value="{{$modalAddPoManufacturer->id}}">{{$modalAddPoManufacturer->name}}</option>
                      @endforeach
                    @endif
                  </select>
                  <label for="floatingSelect">Manufacturer</label>
                  @error('manufacturer_id') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" placeholder="Purchase Order Date" id="datepicker-po-edit" name="date_of_purchase_order" wire:model.defer="date_of_purchase_order" value=1></p>
                  <label for="floatingInput">Purchase Order Date</label>
                  @error('purchase_order_date') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" placeholder="Date Needed" id="datepicker-po-needed-edit" name="date_needed" wire:model.defer="date_needed" value=1></p>
                  <label for="floatingInput">Date Needed</label>
                  @error('date_needed') <span class="text-danger">{{$message}}</span> @enderror
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
                        <button class="btn btn-danger btn-lg" wire:click.prevent="deleteProductModal({{$key}})">remove</button>
                      </div>
                    </div>
                  @endforeach
                </div>
                <div class="form-floating mb-3">
                  <button type="button" class="btn btn-primary" wire:click.prevent="addProductModal({{$productCounts}})">Add Product</button>
                </div>
                <div class="form-floating mb-3"">
                  <button type="submit" class="btn btn-primary" wire:click.prevent="update()">Add Purchase Order</button>
                </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
  <script>
        // new Pikaday({ 
        //   field: document.getElementById('datepicker-po'),
        //   format: 'YYYY-MM-DD',
        // });
        // new Pikaday({ 
        //   field: document.getElementById('datepicker-po-needed'),
        //   format: 'YYYY-MM-DD', 
        // });
    $( function() {
      $( "#datepicker-po-edit" ).datepicker({ dateFormat: 'yy-mm-dd' });
      $( "#datepicker-po-needed" ).datepicker({ dateFormat: 'yy-mm-dd' });

      $('#datepicker-po-edit').on('change', function (e) {
        @this.set('date_of_purchase_order', e.target.value);
      });
      $('#datepicker-po-needed').on('change', function (e) {
        @this.set('date_needed', e.target.value);
      });
    });
  </script>
</div>