<div class="content">
    @livewire('navbar')
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        @if(session()->has('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Product Categories</h6>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductCategory">
                    Add Product Category
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
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productCategories as $productCategory)
                        <tr>
                            <td>{{$productCategory->name}}</td>
                            <td>
                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editProductCategory" wire:click.prevent="edit({{$productCategory->id}})">Edit</button>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteProductCategory" wire:click.prevent="modalDelete({{$productCategory->id}})">Delete</button>
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
    @include('modals.product.prod-cat-add-form')
    @include('modals.product.prod-cat-edit-form')
    @include('modals.product.prod-cat-delete-form')
</div>
