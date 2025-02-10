<x-layout2>
    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite" style="padding-top: 7rem; padding-bottom:10rem; ">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="tab-class text-center">
                        <div class="row g-4">
                            <div class="col-lg-4 text-start"></div>
                            <div class="col-lg-8 text-end">
                                <ul class="nav nav-pills d-inline-flex text-center mb-5">
                                    <!-- "All Menu" Tab -->
                                    <li class="nav-item">
                                        <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill"
                                            href="#tab-all">
                                            <span class="text-dark" style="width: 130px;">All Menu</span>
                                        </a>
                                    </li>
                                    <!-- Category Tabs -->
                                    @foreach ($categories as $category)
                                        <li class="nav-item">
                                            <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill"
                                                href="#tab-{{ $category->id }}">
                                                <span class="text-dark"
                                                    style="width: 130px;">{{ $category->name }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content menu">
                            <!-- "All Menu" Tab Content -->
                            <div id="tab-all" class="tab-pane fade show p-0 active">
                                <div class="row g-4">
                                    <div class="col-lg-12">
                                        <div class="row g-4">
                                            @foreach ($menus as $menu)
                                                <div class="col-md-6 col-lg-4 col-xl-3">
                                                    <div class="rounded position-relative fruite-item border border-secondary rounded-bottom"
                                                        {{-- onclick="location.href='{{ route('detail.detail', ['id' => $menu->id]) }}';" --}} style="cursor: pointer;">
                                                        <div class="p-4">
                                                            <div class="fruite-img">
                                                                <img src="{{ Storage::url($menu->img) }}"
                                                                    class="img-fluid w-100 " alt="{{ $menu->name }}"
                                                                    style="border-radius: 10px;">
                                                            </div>
                                                        </div>
                                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                            style="top: 10px; left: 10px;">
                                                            {{ $categories->firstWhere('id', $menu->category_id)->name ?? 'Unknown' }}
                                                        </div>
                                                        <div class="p-4 ">
                                                            <h5>{{ $menu->name }}</h5>
                                                            <p>{{ Str::limit($menu->desc_produk, 50) }}</p>
                                                            <div
                                                                class="d-flex justify-content-between flex-lg-wrap align-items-center">
                                                                <p class="text-dark fs-5 fw-bold mb-0">
                                                                    Rp.{{ number_format($menu->price, 0, ',', '.') }}
                                                                    /pcs
                                                                </p>
                                                                <form id="add-to-cart-form-{{ $menu->id }}"
                                                                    action="{{ route('cart.add') }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="menu_id"
                                                                        value="{{ $menu->id }}">
                                                                    <input type="hidden" name="quantity"
                                                                        value="1">
                                                                    <button type="button"
                                                                        class="btn border border-secondary rounded-pill px-3 text-primary"
                                                                        onclick="addToCart({{ $menu->id }})">
                                                                        <i class="fa fa-shopping-bag"></i>
                                                                    </button>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Category Tabs Content -->
                            @foreach ($categories as $category)
                                <div id="tab-{{ $category->id }}" class="tab-pane fade show p-0">
                                    <div class="row g-4">
                                        <div class="col-lg-12">
                                            <div class="row g-4">
                                                @foreach ($menus->where('category_id', $category->id) as $menu)
                                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                                        <div class="rounded position-relative fruite-item border border-secondary rounded-bottom"
                                                            onclick="location.href='{{ route('detail.detail', ['id' => $menu->id]) }}';"
                                                            style="cursor: pointer;">
                                                            <div class="p-4">
                                                                <div class="fruite-img">
                                                                    <img src="{{ Storage::url($menu->img) }}"
                                                                        class="img-fluid w-100 "
                                                                        alt="{{ $menu->name }}"
                                                                        style="border-radius: 10px;">
                                                                </div>
                                                            </div>
                                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                                style="top: 10px; left: 10px;">
                                                                {{ $category->name }}
                                                            </div>
                                                            <div class="p-4 ">
                                                                <h5>{{ $menu->name }}</h5>
                                                                <p>{{ Str::limit($menu->desc_produk, 50) }}</p>
                                                                <div
                                                                    class="d-flex justify-content-between flex-lg-wrap align-items-center">
                                                                    <p class="text-dark fs-5 fw-bold mb-0">
                                                                        Rp.{{ $menu->price }} /pcs</p>
                                                                    <form id="add-to-cart-form-{{ $menu->id }}"
                                                                        action="{{ route('cart.add') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="menu_id"
                                                                            value="{{ $menu->id }}">
                                                                        <input type="hidden" name="quantity"
                                                                            value="1">
                                                                        <button type="button"
                                                                            class="btn border border-secondary rounded-pill px-3 text-primary"
                                                                            onclick="addToCart({{ $menu->id }})">
                                                                            <i class="fa fa-shopping-bag"></i>
                                                                        </button>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        function addToCart(menuId) {
            event.stopPropagation(); // Mencegah event klik dari elemen parent
            const form = document.getElementById('add-to-cart-form-' + menuId);
            const formData = new FormData(form);
    
            fetch('{{ route('cart.add') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                })
                .then(response => {
                    // console.log('Response status:', response.status); // Tambahkan log untuk status respons
                    return response.json();
                })
                .then(data => {
                    if (data.message) {
                        // Tampilkan SweetAlert saat berhasil menambah ke keranjang
                        Swal.fire({
                            title: 'Berhasil!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Tampilkan SweetAlert untuk kesalahan
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat menambahkan ke keranjang.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        }
    </script> --}}

    <!-- Fruits Shop End-->
    <script>
        function addToCart(menuId) {
            event.stopPropagation();
            
            const form = document.getElementById('add-to-cart-form-' + menuId);
            const formData = new FormData(form);

            fetch('{{ route('cart.add', ['table_id' => request()->id]) }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        Swal.fire({
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK',
                            customClass: {
                                popup: 'small-swal-popup',
                                icon: 'small-swal-icon',
                                confirmButton: 'small-swal-button'
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat menambahkan ke keranjang.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        }
    </script>
    <style>
        .small-swal-popup {
            max-width: 300px;
            padding: 10px;
        }

        .small-swal-icon {
            font-size: 10px;
            margin-top: 0;
        }

        .small-swal-button {
            font-size: 12px;
            padding: 5px 10px;
            margin-top: 0.5rem;
            height: auto;
        }

        .swal2-actions {
            margin: 0;
        }
    </style>
</x-layout2>
