<x-layout2>
    <!-- Cart Page Start -->
    <div class="container-fluid or" style="padding-top: 7rem; padding-bottom:10rem;">
        <div class="container">
            {{-- <div class="row g-4">
                <div class="col-lg-4 text-start"></div>
                    <div class="col-lg-8 text-end pr">
                        <ul class="nav nav-pills d-inline-flex text-center mb-5">
                            <li class="nav-item ">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill"
                                    href="#tab-all">
                                    <span class="text-dark " style="width: 130px;">All Menu</span>
                                </a>
                            </li>
                        </ul>
                    </div>
            </div> --}}
            <div class="container-fluid">
                <div class="container">
                    <div class="table-responsive or">
                        <div class="d-flex flex-column">
                            @if ($orders->isNotEmpty())
                                @php
                                    // Mengelompokkan pesanan berdasarkan order_id
                                    $groupedOrders = $orders->groupBy('order_id'); // Ganti 'order_id' dengan nama kolom yang sesuai
                                @endphp
            
                                @foreach ($groupedOrders as $orderId => $group)
                                    @foreach ($group as $order)
                                        <!-- Tampilkan data order di sini -->
                                        <div class="d-flex align-items-center p-3 border rounded">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="{{ Storage::url($order->menu->img) }}"
                                                    class="img-fluid rounded-circle" style="width: 80px; height: 80px;"
                                                    alt="">
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="mb-0">{{ $order->menu->name }}</p>
                                            </div>
                                            <div class="flex-grow-1"></div>
                                            <div class="flex-shrink-0 ms-3">
                                                <p class="mb-0">Qty: {{ $order->qty }}</p>
                                            </div>
                                            <div class="flex-shrink-0 ms-3">
                                                <p class="mb-0">Rp.{{ $order->harga }}</p>
                                            </div>
                                        </div>
                                    @endforeach
            
                                    <div class="col-12">
                                        <div class="form-item">
                                            <label for="order-notes" class="ne">Note:</label>
                                            <div class="d-flex align-items-center n p-3 border rounded">
                                                <p class="ne">{{ $group->first()->order->note }}</p> <!-- Menampilkan note pertama dari kelompok -->
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="container text-center">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-6">
                                            <i class="far fa-grin-tears display-1 text-secondary"></i>
                                            <h1 class="display-1">Upss!!</h1>
                                            <h1 class="mb-4">Laperr boss??</h1>
                                            <p class="mb-4">We’re sorry, the page you have looked for does not exist in our website! Maybe go to our home page or try to use a search?</p>
                                            <a class="btn border-secondary rounded-pill py-3 px-5" href="{{ url('/rest') }}">Order Dulu Brooo</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>
    <!-- Cart Page End -->
</x-layout2>
