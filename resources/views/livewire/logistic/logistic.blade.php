<div class="content">
    @livewire('navbar')
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        @if(session()->has('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Delivered Products</h6>
                <!-- Button trigger modal -->
                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'logistic')
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDelivered" wire:click="purchaseOrderModal">
                        Add Delivered Products
                    </button>
                @endif
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
                            <th scope="col">Purchase Order #</th>
                            <th scope="col">Product</th>
                            <th scope="col">Delivered</th>
                            <th scope="col">Remaining</th>
                            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'logistic')
                                <th scope="col">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logistics as $logistic)
                        <tr>
                            <td>{{$logistic->purchaseOrder->purchase_order_number}}</td>
                            <td>{{$logistic->product->name}}</td>
                            <td>{{$logistic->quantity}}</td>
                            <td>{{$logistic->purchaseOrderProduct->remaining}}</td>
                            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'logistic')
                                <td>
                                    {{-- <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editDelivered" wire:click="edit({{$logistic->id}})">Edit</button> --}}
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteDelivered" wire:click.prevent="modalDelete({{$logistic->id}})">Delete</button>
                                </td>
                            @endif
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>

                
            </div>
            {{-- {{ $manufacturers->links() }} --}}
        </div>
    </div>
    <!-- Recent Sales End -->
    @include('footer')
    @include('modals.logistic.logistic-add-form')
    {{-- @include('modals.logistic.logistic-edit-form') --}}
    @include('modals.logistic.logistic-delete-form')
</div>
