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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPoPayment" wire:click.prevent="addPoPaymentModal">
                    Add Purchase Order Payment
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
                            <th scope="col">Purchase Order #</th>
                            <th scope="col">Date of Payment</th>
                            <th scope="col">Payment</th>
                            <th scope="col">Remaining Balance</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($purchaseOrderPayments)
                            @foreach($purchaseOrderPayments as $purchaseOrderPayment)
                                <tr>
                                    <td>{{$purchaseOrderPayment->purchaseOrder->purchase_order_number}}</td>
                                    <td>{{$purchaseOrderPayment->date_of_payment}}</td>
                                    <td>{{$purchaseOrderPayment->payment}}</td>
                                    <td>{{$purchaseOrderPayment->purchaseOrder->remaining_balance}}</td>
                                    <td>
                                        <button class="btn btn-info m-1" data-bs-toggle="modal" data-bs-target="#editPoPayment" wire:click.prevent="edit({{$purchaseOrderPayment->id}})">Edit</button>
                                        <button class="btn btn-danger m-1" data-bs-toggle="modal" data-bs-target="#deletePoPayment" wire:click.prevent="modalDelete({{$purchaseOrderPayment->id}})">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

                
            </div>
            {{ $purchaseOrderPayments->links() }}
        </div>
    </div>
    <!-- Recent Sales End -->
    @include('footer')
    @include('modals.po.po-add-payment-form')
    @include('modals.po.po-edit-payment-form')
    @include('modals.po.po-delete-payment-form')
</div>
