<div class="content">
    @livewire('navbar')
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        @if(session()->has('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Manual Stocks</h6>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addManualStock" wire:click="manualAddStockModal">
                    Add Stocks
                </button>
            </div>
            <div class="col-sm-8 col-xl-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name" wire:model="searchTerm">
                    <label for="floatingInput">Search</label>
                </div>
            </div>
            <div class="table-responsive">
                
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Product</th>
                            <th scope="col">Operation</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Added By</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($manualStocks as $manualStock)
                        <tr>
                            <td>{{$manualStock->product->name}}</td>
                            <td>{{$manualStock->operation}}</td>
                            <td>{{$manualStock->quantity}}</td>
                            <td>{{$manualStock->user->name}}</td>
                            <td>
                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editManualStock" wire:click="edit({{$manualStock->id}})">Edit</button>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteManualStock" wire:click.prevent="modalDelete({{$manualStock->id}})">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>

                
            </div>
            {{ $manualStocks->links() }}
        </div>
    </div>
    <!-- Recent Sales End -->
    @include('footer')
    @include('modals.logistic.manual-add-form')
    @include('modals.logistic.manual-edit-form')
    @include('modals.logistic.manual-delete-form')
</div>
