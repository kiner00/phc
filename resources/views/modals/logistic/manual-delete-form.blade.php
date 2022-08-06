<div wire:ignore.self class="modal fade" id="deleteManualStock" tabindex="-1" aria-labelledby="deleteManualStockLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteManualStockLabel">Delete Manual Stocks</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <span>Are you sure you want to delete this Manual Stocks?</span>
            <form>
              <input type="hidden" name="id" wire-model="ids" />
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger" wire:click.prevent="delete()">Delete Manual Stock</button>
        </div>
      </div>
    </div>
</div>