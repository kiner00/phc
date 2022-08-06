<div>
    <form>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" placeholder="Complete Name" name="name" wire:model.defer="name"/>
            <label for="floatingInput">Complete Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" placeholder="name@example.com" name="email" wire:model.defer="email"/>
            <label for="floatingInput">Email address</label>
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
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password" wire:model.defer="password">
            <label for="floatingPassword">Password</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" wire:model.defer="password_confirmation">
            <label for="floatingPassword">Confirm Password</label>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Profile Picture</label>
            <input class="form-control" type="file" name="image" wire:model.defer="image">
        </div>
        <button type="submit" class="btn btn-primary" wire:click.prevent="store()">Register</button>
    </form>
</div>
