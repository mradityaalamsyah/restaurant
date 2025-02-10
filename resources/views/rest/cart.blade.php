<x-layout2>
    <!-- Cart Page Start -->
    <div class="container-fluid cart">
        <div class="container">
            <div class="table-responsive">
                <div class="d-flex flex-column">
                    @if ($carts->isEmpty())
                    <!-- Pesan ketika keranjang kosong -->
                    <div class="container text-center">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <i class="far fa-grin-tears display-1 text-secondary"></i>
                                <h1 class="display-1">Upss!!</h1>
                                <h1 class="mb-4">Laperr boss??</h1>
                                <p class="mb-4">Jangan sampai rasa laparmu menghilangkan sebagian akalmu , keranjangnya masih kosong bang !!</p>
                                <a class="btn border-secondary rounded-pill py-3 px-5" href="{{ url('/rest') }}">Tambah menu dulu Brooo</a>
                            </div>
                        </div>
                    </div>
                    @else
                    @foreach ($carts as $cart)
                        <div class="d-flex align-items-center mb-3 p-3 border rounded" id="cart-item-{{ $cart->id }}">
                            <div class="flex-shrink-0 me-3">
                                <img src="{{ Storage::url($cart->menu->img) }}" class="img-fluid rounded-circle"
                                    style="width: 80px; height: 80px;" alt="">
                            </div>
                            <div class="flex-grow-1">
                                <p class="mb-0">{{ $cart->menu->name }}</p>
                            </div>
                            <form class="d-flex align-items-center">
                                <button type="button" data-id="{{ $cart->id }}" data-action="decrement"
                                    class="btn btn-xs btn-minus update-cart-btn rounded-circle bg-light border d-flex align-items-center justify-content-center p-1 me-2"
                                    style="width: 24px; height: 24px;">
                                    <i class="fa fa-minus" style="font-size: 12px;"></i>
                                </button>
                                <input type="text" class="form-control form-control-xs text-center border-0 p-0 me-2"
                                    value="{{ $cart->qty }}" readonly
                                    style="height: 24px; font-size: 12px; width: 40px;" id="qty-{{ $cart->id }}">
                                <button type="button" data-id="{{ $cart->id }}" data-action="increment"
                                    class="btn btn-xs btn-plus update-cart-btn rounded-circle bg-light border d-flex align-items-center justify-content-center p-1"
                                    style="width: 24px; height: 24px;">
                                    <i class="fa fa-plus" style="font-size: 12px;"></i>
                                </button>
                            </form>
                            <div class="flex-shrink-0 ms-3">
                                <p class="mb-0" id="total-{{ $cart->id }}">
                                    Rp.{{ number_format($cart->total, 0, ',', '.') }}</p>
                            </div>
                            <div class="flex-shrink-0 ms-3">
                                <form action="{{ route('cart.destroy', $cart->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-md rounded-circle bg-light border">
                                        <i class="far fa-trash-alt text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-16 col-md-14 col-lg-16">
                    <div class="text-end me-4 mb-4">
                        <a href="{{ route('rest.vmenu',['id' => session('table_id')]) }}">
                            <button
                                class="btn btn-sm border-secondary rounded-pill px-3 py-2 text-primary text-uppercase mb-4 ms-4"
                                type="button">Tambah Pesanan</button>
                        </a>
                        {{-- @if ($carts->count() > 0) --}}
                            <!-- Cek apakah cart tidak kosong -->
                            <a href="{{ route('checkout.checkout',['id' => session('table_id')]) }}" id="checkout-button">
                                <button
                                    class="btn btn-sm border-secondary rounded-pill px-3 py-2 text-primary text-uppercase mb-4 ms-4"
                                    type="button">Checkout</button>
                            </a>
                        {{-- @endif --}}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <!-- Cart Page End -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Menambahkan event listener untuk semua tombol update cart
            document.querySelectorAll('.update-cart-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const cartId = this.getAttribute('data-id');
                    const action = this.getAttribute('data-action');

                    fetch(`/api/cart/update/${cartId}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Menambahkan CSRF Token
                            },
                            body: JSON.stringify({
                                action: action
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.deleted) {
                                // Menghapus elemen cart item dari halaman jika item dihapus
                                document.getElementById(`cart-item-${cartId}`).remove();
                            } else if (data.cartItem) {
                                // Update quantity dan total pada halaman tanpa reload
                                document.getElementById(`qty-${cartId}`).value = data.cartItem
                                    .qty;
                                document.getElementById(`total-${cartId}`).textContent =
                                    `Rp.${new Intl.NumberFormat('id-ID').format(data.cartItem.total)}`;
                            } else {
                                console.error('Failed to update cart:', data.message);
                            }
                            // checkCart();
                        })
                        .catch(error => console.error('Error updating cart:', error));
                });
            });

            // function checkCart() {
            //     // Memeriksa apakah ada item di cart
            //     const cartItems = document.querySelectorAll('[id^="cart-item-"]');
            //     const checkoutButton = document.getElementById('checkout-button');

            //     // Jika tidak ada item di cart, sembunyikan tombol checkout
            //     if (cartItems.length === 0) {
            //         checkoutButton.style.display = 'none';
            //     } else {
            //         checkoutButton.style.display = 'inline-block'; // Tampilkan jika ada item
            //     }
            // }

        });
    </script>
    
    {{-- checkoutbutton --}}
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Menambahkan event listener untuk semua tombol update cart
            document.querySelectorAll('.update-cart-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const cartId = this.getAttribute('data-id');
                    const action = this.getAttribute('data-action');

                    fetch(`/api/cart/update/${cartId}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Menambahkan CSRF Token
                            },
                            body: JSON.stringify({
                                action: action
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.deleted) {
                                // Menghapus elemen cart item dari halaman jika item dihapus
                                document.getElementById(`cart-item-${cartId}`).remove();
                            } else if (data.cartItem) {
                                // Update quantity dan total pada halaman tanpa reload
                                document.getElementById(`qty-${cartId}`).value = data.cartItem
                                    .qty;
                                document.getElementById(`total-${cartId}`).textContent =
                                    `Rp.${new Intl.NumberFormat('id-ID').format(data.cartItem.total)}`;
                            }

                            // Cek apakah cart kosong untuk menampilkan atau menyembunyikan tombol checkout
                            updateCheckoutButtonVisibility();
                        })
                        .catch(error => console.error('Error updating cart:', error));
                });
            });

            // Fungsi untuk memperbarui visibilitas tombol checkout
            function updateCheckoutButtonVisibility() {
                const cartItems = document.querySelectorAll('[id^="cart-item-"]');
                const checkoutButton = document.getElementById('checkout-button');
                if (cartItems.length === 0) {
                    checkoutButton.style.display = 'none'; // Sembunyikan tombol checkout
                } else {
                    checkoutButton.style.display = 'block'; // Tampilkan tombol checkout
                }
            }

            // Panggil fungsi untuk set visibilitas tombol checkout saat halaman dimuat
            updateCheckoutButtonVisibility();
        });
    </script> --}}



</x-layout2>
