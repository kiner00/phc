<div class="content">
    @livewire('navbar')
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        @if(session()->has('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Purchase Orders</h6>
                <!-- Button trigger modal -->
                @if(Auth::user()->role == 'admin')
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPo" wire:click.prevent="addPoModal">
                        Add Purchase Order
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
                            <th scope="col">Manufacturer</th>
                            <th scope="col">Date of PO</th>
                            <th scope="col">Date Needed</th>
                            <th scope="col">Product/s</th>
                            <th scope="col">Status</th>
                            <th scope="col">Remaining Balance</th>
                            <th scope="col">Total Cost</th>
                            @if(Auth::user()->role == 'admin')
                                <th scope="col">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchaseOrders as $purchaseOrder)
                        <tr>
                            <td>{{$purchaseOrder->purchase_order_number}}</td>
                            <td>{{$purchaseOrder->manufacturer->name}}</td>
                            <td>{{$purchaseOrder->date_of_purchase_order}}</td>
                            <td>{{$purchaseOrder->date_needed}}</td>
                            <td>
                                @if($purchaseOrder->purchaseOrderProducts)
                                    <ul>
                                        @foreach($purchaseOrder->purchaseOrderProducts as $product)
                                            <li>
                                                {{$product->product->name}} - {{$product->quantity}} pc/s
                                            </li>   
                                        @endforeach
                                    </ul>
                                @endif
                            </td>
                            <td>{{$purchaseOrder->status}}</td>
                            <td>Php {{number_format($purchaseOrder->remaining_balance, 2)}}</td>
                            <td>Php {{number_format($purchaseOrder->total_cost, 2)}}</td>
                            @if(Auth::user()->role == 'admin')
                                <td>
                                    <button class="btn btn-info m-1" data-bs-toggle="modal" data-bs-target="#editPo" wire:click.prevent="edit({{$purchaseOrder->id}})">Edit</button>
                                    <button class="btn btn-danger m-1" data-bs-toggle="modal" data-bs-target="#deletePo" wire:click.prevent="modalDelete({{$purchaseOrder->id}})">Delete</button>
                                </td>
                            @endif
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>

                
            </div>
            {{ $purchaseOrders->links() }}
        </div>
    </div>
    <!-- Recent Sales End -->
    @include('footer')
    @include('modals.po.po-add-form')
    @include('modals.po.po-edit-form')
    @include('modals.po.po-delete-form')
    @include('modals.po.po-edit-payment-form')
</div>
