<x-layout2>
    <!-- Checkout Page Start -->
    <div class="container-fluid " style="padding-top: 7rem; padding-bottom:10rem;">
        <div class="container py-5">
            <h1 class="mb-4">Billing Details</h1>
            <form action="{{ route('checkout.placeOrder') }}" method="POST">
                @csrf
                <div class="row g-5">
                    <!-- Order Summary -->
                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="small"></th>
                                        <th scope="col" class="small">Name</th>
                                        <th scope="col" class="small">Price</th>
                                        <th scope="col" class="small">Quantity</th>
                                        <th scope="col" class="small">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carts as $cart)
                                        <tr>
                                            <td>
                                                <img src="{{ Storage::url($cart->menu->img) }}"
                                                    class="img-fluid rounded-circle" style="width: 40px; height: 40px;"
                                                    alt="Product Image">
                                            </td>
                                            <td class="py-3 small">{{ $cart->menu->name }}</td>
                                            <td class="py-3 small">
                                                Rp.{{ number_format($cart->menu->price, 0, ',', '.') }}
                                            </td>
                                            <td class="py-3 small text-center">{{ $cart->qty }}</td>
                                            <td class="py-3 small">{{ number_format($cart->total, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4" class="mb-0 text-dark text-uppercase py-2 pt-4 small">TOTAL
                                        </td>
                                        <td class="">
                                            <p class="mb-0 text-dark small" id="subtotal">
                                                {{ number_format($subtotal, 0, ',', '.') }}</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <input type="hidden" name="carts" value="{{ json_encode($carts->pluck('id')) }}">
                    <!-- Billing Information -->
                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Nama</label>
                                    <input type="text" name="nameuser"
                                        class="form-control @error('nameuser') is-invalid @enderror">
                                    @error('nameuser')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Meja</label>
                                    <?php
                                    $tableId = session('table_id');
                                    $table = \App\Models\Table::find($tableId);
                                    ?>
                                    <input type="text" name="meja" class="form-control" value="{{ $table->name }}" readonly>
                                    <input type="hidden" name="meja" value="{{ $table->id }}">
                                </div>
                            </div>
                            <!-- Order Notes -->
                            <div class="col-12">
                                <div class="form-item">
                                    <label for="order-notes" class="form-label my-3">Catatan (Opsional)</label>
                                    <textarea id="order-notes" name="note" class="form-control" spellcheck="false" cols="30" rows="4"
                                        placeholder="Tambah catatan..."></textarea>
                                </div>
                            </div>

                            <div
                                class="g-4 text-center align-items-center justify-content-center pt-3 d-flex justify-content-between">
                                <a href="{{ route('rest.vmenu',['id' => session('table_id')]) }}" class="w-100">
                                    <button
                                        type="button"class="btn border-secondary py-2 px-3 text-uppercase w-46 text-primary">Tambah
                                        Menu</button>
                                </a>
                                <button type="submit"
                                    class="btn border-secondary py-2 px-3 text-uppercase w-46 text-primary">Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Checkout Page End -->
</x-layout2>
