<div wire:ignore.self class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addUserLabel">Create New User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="bg-light rounded h-100 p-4">
                <form>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="Complete Name" name="name" wire:model.defer="name"/>
                        <label for="floatingInput">Complete Name</label>
                        @error('name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" placeholder="name@example.com" name="email" wire:model.defer="email"/>
                        <label for="floatingInput">Email address</label>
                        @error('email') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" aria-label="User Role" name="role" wire:model.defer="role">
                            <option selected="">Open this select Role</option>
                            <option value="admin">Admin</option>
                            <option value="freelance">Freelance</option>
                            <option value="accounting">Accounting</option>
                            <option value="logistic">Logistic</option>
                            <option value="manufacturer">Manufacturer</option>
                        </select>
                        <label for="floatingSelect">User Role</label>
                        @error('role') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" wire:model.defer="password">
                        <label for="floatingPassword">Password</label>
                        @error('password') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" wire:model.defer="password_confirmation">
                        <label for="floatingPassword">Confirm Password</label>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Profile Picture</label>
                        <input class="form-control" type="file" name="image" wire:model.defer="image">
                        
                        @error('image') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary" wire:click.prevent="store()">Register</button>
                </form>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
    <script>
        window.on('addUser', ()=> {
            $('#addUser').modal('hide');
        });
    </script>
</div>