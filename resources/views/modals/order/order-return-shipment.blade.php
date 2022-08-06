<div wire:ignore.self class="modal fade" id="returnShipment" tabindex="-1" aria-labelledby="returnShipmentLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="returnShipmentLabel">Change Shipping Status</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <span>Are you sure you want to return shipment:
            <br /> Order Number: <strong>{{$viewOrderNumber}} </strong><br />
            Name: <strong>{{$viewFullName}}?</strong></span>
          <form>
            <input type="hidden" name="id" wire-model="ids" />
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" wire:click.prevent="returnOrderFulfillment()">Return Shipment</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>