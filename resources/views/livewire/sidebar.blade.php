<div>
    <!-- Sidebar Start -->
    <div class="sidebar pe-4 pb-3">
        <nav class="navbar bg-light navbar-light">
            <a href="index.html" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary"></i>PHC</h3>
            </a>
            <div class="d-flex align-items-center ms-4 mb-4">
                <div class="position-relative">
                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                    <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0">{{Auth::user()->name}}</h6>
                    <span>{{Auth::user()->role}}</span>
                </div>
            </div>
            <div class="navbar-nav w-100">
                <a href="/" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                
                @if(Auth::user()->role == "admin")
                    <a href="/users" class="nav-item nav-link"><i class="bi bi-person-circle"></i>Users</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-house"></i>Manufacturers</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="/manufacturers" class="dropdown-item">List of Manufacturers</a>
                            <a href="/manufacturer-accounts" class="dropdown-item">Accounts of Manufacturers</a>
                        </div>
                    </div>
                @endif
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-basket"></i>Product</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="/products" class="dropdown-item">Products</a>
                        <a href="/product-category" class="dropdown-item">Product Category</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-calculator"></i>Purchase Order</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="/purchase-orders" class="dropdown-item">Purchase Order</a>
                        <a href="/purchase-order/payments" class="dropdown-item">Purchase Order Payments</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-truck"></i></i>Logistics</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="/logistics" class="dropdown-item">Logistics</a>
                        <a href="/logistic/manual-stocks" class="dropdown-item">Manual Stocks</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-truck"></i></i>Orders</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="/orders" class="dropdown-item">Orders</a>
                        <a href="/platforms" class="dropdown-item">Platforms</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
