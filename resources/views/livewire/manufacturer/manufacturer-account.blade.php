<div class="content">
    @livewire('navbar')
    @if(Auth::user()->role == "admin")
        <div class="container-fluid pt-4 px-4">
            @if(session()->has('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Manufacturer Accounts</h6>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addManufacturerAccount" wire:click.prevent="addManufAccountForm">
                        Assign Account
                    </button>
                </div>
                {{-- <div class="col-sm-8 col-xl-4">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name" wire:model="searchTerm">
                        <label for="floatingInput">Search</label>
                    </div>
                </div> --}}
                <div class="table-responsive">
                    
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col">Email</th>
                                <th scope="col">Name</th>
                                <th scope="col">Manufacturer</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($manufacturerAccounts as $manufacturerAccount)
                            <tr>
                                <td>{{$manufacturerAccount->user->email}}</td>
                                <td>{{$manufacturerAccount->user->name}}</td>
                                <td>{{$manufacturerAccount->manufacturer->name}}</td>
                                {{-- <td>
                                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editManufacturer" wire:click.prevent="edit({{$manufacturer->id}})">Edit</button>
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteManufacturer" wire:click.prevent="modalDelete({{$manufacturer->id}})">Delete</button>
                                </td> --}}
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>

                    
                </div>
                {{-- {{ $manufacturers->links() }} --}}
            </div>
        </div>
    @endif
    @include('footer')
    @include('modals.manufacturer.manufacturer-account-assign-form')
</div>