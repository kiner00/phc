<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script type="text/JavaScript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <link rel="stylesheet" href="lib/owlcarousel/assets/owl.carousel.min.css" type="text/css">
        <link rel="stylesheet" href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" type="text/css">
        @vite([
            // "resources/css/bootstrap.min.css",
            // "resources/css/style.css",
            // "resources/lib/owlcarousel/assets/owl.carousel.min.css",
            // "resources/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css"
        ])

        <style>
            nav svg {
                height: 20px;
            }
        </style>
        @livewireStyles
    </head>
    <body>
        @include('spinner')
        @livewire('sidebar')

        {{ $slot }}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
        
        <!-- JavaScript Libraries -->
        {{-- <script src="{{env('APP_URL')}}/resources/lib/chart/chart.min.js"></script>
        <script src="{{env('APP_URL')}}/resources/lib/easing/easing.min.js"></script>
        <script src="{{env('APP_URL')}}/resources/lib/waypoints/waypoints.min.js"></script>
        <script src="{{env('APP_URL')}}/resources/lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="{{env('APP_URL')}}/resources/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script> 
        <script src="{{env('APP_URL')}}/resources/js/main.js"></script> --}}
        @vite([
            // "resources/lib/chart/chart.min.js",
            // "resources/lib/easing/easing.min.js",
            // "resources/lib/waypoints/waypoints.min.js",
            // "resources/lib/owlcarousel/owl.carousel.min.js",
            // "resources/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js",
            // "resources/js/main.js"
        ])
        
        @livewireScripts
        
        <script>
            window.livewire.on('addedUser', () => {
                $('#addUser').modal('hide');
            });

            window.livewire.on('updatedUser', () => {
                $('#editUser').modal('hide');
            });

            window.livewire.on('deletedUser', () => {
                $('#deleteUser').modal('hide');
            });

            window.livewire.on('addedManufacturer', () => {
                $('#addManufacturer').modal('hide');
            });

            window.livewire.on('updatedManufacturer', () => {
                $('#editManufacturer').modal('hide');
            });

            window.livewire.on('deletedManufacturer', () => {
                $('#deleteManufacturer').modal('hide');
            });

            window.livewire.on('addedUserManufacturer', () => {
                $('#addManufacturerAccount').modal('hide');
            });

            window.livewire.on('addedProductCategory', () => {
                $('#addProductCategory').modal('hide');
            });

            window.livewire.on('updatedProductCategory', () => {
                $('#editProductCategory').modal('hide');
            });

            window.livewire.on('deletedProductCategory', () => {
                $('#deleteProductCategory').modal('hide');
            });

            window.livewire.on('addedProduct', () => {
                $('#addProduct').modal('hide');
            });

            window.livewire.on('updatedProduct', () => {
                $('#editProduct').modal('hide');
            });

            window.livewire.on('deletedProduct', () => {
                $('#deleteProduct').modal('hide');
            });

            window.livewire.on('addedPurchaseOrder', () => {
                $('#addPo').modal('hide');
            });

            window.livewire.on('updatedPurchaseOrder', () => {
                $('#editPo').modal('hide');
            });

            window.livewire.on('deletedPurchaseOrder', () => {
                $('#deletePo').modal('hide');
            });

            window.livewire.on('addedPurchaseOrderPayment', () => {
                $('#addPoPayment').modal('hide');
            });

            window.livewire.on('updatedPurchaseOrderPayment', () => {
                $('#editPoPayment').modal('hide');
            });

            window.livewire.on('deletedPurchaseOrderPayment', () => {
                $('#deletePoPayment').modal('hide');
            });

            window.livewire.on('addedDelivered', () => {
                $('#addDelivered').modal('hide');
            });

            window.livewire.on('deletedDelivered', () => {
                $('#deleteDelivered').modal('hide');
            });

            window.livewire.on('addedManual', () => {
                $('#addManualStock').modal('hide');
            });

            window.livewire.on('updatedManual', () => {
                $('#editManualStock').modal('hide');
            });

            window.livewire.on('deletedManual', () => {
                $('#deleteManualStock').modal('hide');
            });

            window.livewire.on('addedPlatform', () => {
                $('#addPlatform').modal('hide');
            });

            window.livewire.on('updatedPlatform', () => {
                $('#editPlatform').modal('hide');
            });

            window.livewire.on('deletedPlatform', () => {
                $('#deletePlatform').modal('hide');
            });

            window.livewire.on('addedOrder', () => {
                $('#addOrder').modal('hide');
            });

            window.livewire.on('updatedOrder', () => {
                $('#editOrder').modal('hide');
            });

            window.livewire.on('deletedOrder', () => {
                $('#deleteOrder').modal('hide');
            });

            window.livewire.on('addedOrderFulfillment', () => {
                $('#arrangeShipment').modal('hide');
            });

            window.livewire.on('returnedOrderFulfillment', () => {
                $('#returnShipment').modal('hide');
            });

            window.livewire.on('test', () => {
                alert('test');
            });
        </script>

        <livewire:scripts />

        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>

        @livewireChartsScripts
    </body>
</html>
