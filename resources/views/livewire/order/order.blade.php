<div class="content">
    @livewire('navbar')
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        @if(session()->has('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Customer Orders</h6>
                <!-- Button trigger modal -->
                @if(Auth::user()->role == "admin")
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addOrder" wire:click.prevent="addOrderModal">
                        Add Order
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
                            <th scope="col">Platform</th>
                            <th scope="col">Order Number</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Processed By</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{$order->platform->platform}}</td>
                            <td>{{$order->order_number}}</td>
                            <td>{{$order->full_name}}</td>
                            <td>{{$order->processedBy->name}}</td>
                            <td>
                                @if(Auth::user()->role == "logistic")
                                    @if($order->orderFulfillment)
                                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#returnShipment" wire:click.prevent="arrangeShipmentModal({{$order->id}})"><i class="bi bi-arrow-counterclockwise"></i></button>
                                    @else
                                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#arrangeShipment" wire:click.prevent="arrangeShipmentModal({{$order->id}})"><i class="bi bi-truck"></i></button>
                                    @endif
                                @else
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#viewOrder" wire:click.prevent="viewOrder({{$order->id}})"><i class="bi bi-info-circle"></i></button>
                                    @if(!$order->orderFulfillment)
                                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editOrder" wire:click.prevent="edit({{$order->id}})"><i class="bi bi-pencil"></i></button>
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteOrder" wire:click.prevent="modalDelete({{$order->id}})"><i class="bi bi-trash"></i></button>
                                    @endif
                                @endif
                            </td>
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
    @include('modals.order.order-add-form')
    @include('modals.order.order-edit-form')
    @include('modals.order.order-delete-form')
    @include('modals.order.order-view-order')
    @include('modals.order.order-arrange-shipment')
    @include('modals.order.order-return-shipment')
</div>