<div wire:ignore.self class="modal fade" id="deletePlatform" tabindex="-1" aria-labelledby="deletePlatformLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deletePlatformLabel">Delete Platform</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <span>Are you sure you want to delete Platform?</span>
            <form>
              <input type="hidden" name="id" wire-model="ids" />
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger" wire:click.prevent="delete()">Delete Platform</button>
        </div>
      </div>
    </div>
</div>