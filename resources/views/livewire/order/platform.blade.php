<div class="content">
    @livewire('navbar')
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        @if(session()->has('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Platforms</h6>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPlatform">
                    Add platform
                </button>
            </div>
            <div class="table-responsive">
                
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Name of Platform</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($platforms as $platform)
                        <tr>
                            <td>{{$platform->platform}}</td>
                            <td>
                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editPlatform" wire:click.prevent="edit({{$platform->id}})">Edit</button>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletePlatform" wire:click.prevent="modalDelete({{$platform->id}})">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>

                
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->
    @include('footer')
    @include('modals.order.platform-add-form')
    @include('modals.order.platform-edit-form')
    @include('modals.order.platform-delete-form')
</div>
