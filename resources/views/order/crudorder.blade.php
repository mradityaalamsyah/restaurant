<x-layout>
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 text-start"></div>
            <div class="col-lg-8 text-end">
                <ul class="nav nav-pills d-inline-flex text-center ">
                    <!-- Category Tabs -->
                    {{-- @foreach ($orders as $order)
                        <li class="nav-item">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-{{ $order->order->tables_id }}">
                                <span class="text-dark" style="width: 130px;">{{ $order->order->tables_id }}</span>
                            </a>
                        </li>
                    @endforeach --}}
                </ul>
            </div>
        </div>
        <div class="row">
            @foreach ($orders as $order)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-light text-dark text-center fw-bold">
                            {{ $order->tables_id }}
                        </div>
                        <div class="card-body bg-white">
                            <h5 class="card-title text-center text-dark">
                                {{ $order->menu->name }}
                            </h5>
                            <p class="card-text"><strong>Nama:</strong> {{ $order->order->nameuser }}</p>
                            <p class="card-text"><strong>Harga:</strong> Rp{{ number_format($order->harga, 0, ',', '.') }}</p>
                            <p class="card-text"><strong>Qty:</strong> {{ $order->qty }}</p>
                            <p class="card-text"><strong>Total:</strong> Rp{{ number_format($order->harga * $order->qty, 0, ',', '.') }}</p>
                            <p class="card-text"><strong>Note:</strong> {{ $order->order->note }}</p>
                            <p class="card-text"><strong>Time:</strong> {{ $order->updated_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div class="card-footer text-center bg-light">
                            <form action="{{ route('order.destroy', $order->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-success w-100">Pesanan Selesai</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
