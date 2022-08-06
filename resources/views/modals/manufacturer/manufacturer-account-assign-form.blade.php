<div wire:ignore.self class="modal fade" id="addManufacturerAccount" tabindex="-1" aria-labelledby="addManufacturerAccountLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addManufacturerAccountLabel">Assign Manufacturer Account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="bg-light rounded h-100 p-4">
                <form>
                    <div class="form-floating mb-3">
                      <select class="form-select" aria-label="Select Manufacturer" name="manufacturer_id" wire:model="manufacturer_id">
                          <option selected="">Select Manufacturer</option>
                          @if($manufList)
                            @foreach($manufList as $manuf)
                              <option value="{{$manuf->id}}" >{{$manuf->name}}</option>
                            @endforeach
                          @endif
                      </select>
                      <label for="floatingSelect">Select Manufacturer</label>
                    </div>
                    <div class="form-floating mb-3">
                      <select class="form-select" aria-label="Select User" name="user_id" wire:model="user_id">
                          <option selected="">Select User</option>
                          @if($userList)
                            @foreach($userList as $user)
                              <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                          @endif
                      </select>
                      <label for="floatingSelect">Select User</label>
                    </div>
                  <button type="submit" class="btn btn-primary" wire:click.prevent="store()">Register User</button>
                </form>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>