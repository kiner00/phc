<div wire:ignore.self class="modal fade" id="editPoPayment" tabindex="-1" aria-labelledby="editPoPaymentLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPoPaymentLabel">Create New Purchase Order</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="bg-light rounded h-100 p-4">
              <form>
                <input type="hidden" name="id" wire-model="ids" />
                <div class="form-floating mb-3">
                  <select class="form-select" aria-label="Purchase Order" name="purchase_order_id" wire:model="purchase_order_id">
                    <option selected="">Select Purchase Order #</option>
                    @if(isset($poWithBalances))
                      @foreach($poWithBalances as $poWithBalance)
                        <option value="{{$poWithBalance->id}}">{{$poWithBalance->purchase_order_number}}</option>
                      @endforeach
                    @endif
                  </select>
                  <label for="floatingSelect">Purchase Order #</label>
                  @error('purchase_order_id') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" placeholder="Purchase Order Date" id="date-of-payment-edit" name="date_of_payment" wire:model.defer="date_of_payment" value=1></p>
                  <label for="floatingInput">Date of Payment</label>
                  @error('date_of_payment') <span class="text-danger">{{$message}}</span> @enderror
                </div>
                <p>
                  Remaining Balance: <mark>{{$remainingBalance ? "Php ".number_format($remainingBalance, 2) : "Php 0.00"}} </mark>
                </p>
                <div class="form-floating mb-3">
                  <input type="number" class="form-control" placeholder="Payment" name="payment" wire:model="payment"/>
                  <label for="payment">Payment</label>
                  @error('payment') <span class="text-danger">{{$message}}</span> @enderror
                </div>
              </form>
          </div>
      </div>
      
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" wire:click.prevent="update()">Update Purchase Order Payment</button>
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
          $( "#date-of-payment-edit" ).datepicker({ dateFormat: 'yy-mm-dd' });
          $('#date-of-paymen-editt').on('change', function (e) {
            @this.set('date_of_payment', e.target.value);
          });
        });
  </script>
</div>