<div wire:ignore.self class="modal fade" id="deletePo" tabindex="-1" aria-labelledby="deletePoLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deletePoLabel">Delete Purchase Order</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <span>Are you sure you want to delete Purchase Order?</span>
            <form>
              <input type="hidden" name="id" wire-model="ids" />
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger" wire:click.prevent="delete()">Delete Purchase Order</button>
        </div>
      </div>
    </div>
</div>