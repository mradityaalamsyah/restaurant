    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar start -->
    <div class="container-fluid fixed-top">
        <div class="container px-0">
            <nav class="navbar navbar-light bg-white navbar-expand-xl">
                <a href="index.html" class="navbar-brand">
                    <h1 class="text-primary display-6">javarest</h1>
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <x-nav-link2 href="{{ route('login') }}" class="nav-item">Home</x-nav-link2>
                        <x-nav-link2 href="{{ route('rest.vmenu',['id' => session('table_id')]) }}" class="nav-item">Menu</x-nav-link2>
                        <x-nav-link2 href="{{ route('order.index',['id' => session('table_id')]) }}" class="nav-item">Orders</x-nav-link2>
                        <x-nav-link2 href="{{ url('/contact') }}" class="nav-item">Contact</x-nav-link2>
                    </div>
                    <div class="d-flex m-3 me-0">
                        <a href="{{ route('cart.cart',['id' => session('table_id')]) }}" class="position-relative me-4 my-auto" id="cart-button">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="badge bg-danger position-absolute top-0 start-100 translate-middle p-1 border border-light rounded-circle" id="cart-notification" style="display: none;"></span>
                        </a>                        
                        <ul class="navbar-nav m ms-auto me-0 me-md-3 my-2 my-md-0">
                            <li class="nav-item dropdown lo">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false" style="display: flex; align-items: center;">
                                    <i class="fas fa-user fa-fw"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="left: auto; right: 0;">
                                    <li><a class="dropdown-item" href="{{ route('admin.login') }}">Login</a></li>
                                    <li>
                                </ul>
                            </li>
                        </ul>                        
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->