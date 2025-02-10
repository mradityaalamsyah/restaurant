<x-layout>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container-fluid px-4">
        <!-- Tombol Tambah Data -->
        <button class="btn btn-primary mb-3 mt-3" data-bs-toggle="modal" data-bs-target="#formModal">Tambah Data</button>

        <!-- Modal Tambah Data -->
        <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="judulModal">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('table.store') }}" method="post" class="p-3 bg-light rounded shadow-sm">
                            @csrf
                            <!-- Nama -->
                            <div class="form-group mb-3">
                                <label for="name" class="form-label fw-bold">Nama :</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama" required>
                            </div>
                            <!-- Tombol Aksi -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Tambah Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menampilkan Data Tabel -->
        <div class="row">
            @foreach ($tables as $table)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $table->name }}</h5>
                            <div class="mb-3">
                                {!! QrCode::size(150)->generate($table->qr) !!} <!-- Tampilkan QR Code -->
                            </div>
                            <div class="d-flex justify-content-center">
                                <!-- Tombol Update -->
                                <button class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#updateModal{{ $table->id }}">Update</button>

                                <!-- Tombol Delete -->
                                <form action="{{ route('table.destroy', $table->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Update Data -->
                <div class="modal fade" id="updateModal{{ $table->id }}" tabindex="-1" aria-labelledby="updateModalLabel{{ $table->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateModalLabel{{ $table->id }}">Update Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('table.update', $table->id) }}" method="POST" class="p-3 bg-light rounded shadow-sm">
                                    @csrf
                                    @method('PUT')
                                    <!-- Nama -->
                                    <div class="form-group mb-3">
                                        <label for="name{{ $table->id }}" class="form-label fw-bold">Nama :</label>
                                        <input type="text" name="name" id="name{{ $table->id }}" class="form-control" value="{{ $table->name }}" required>
                                    </div>
                                    <!-- Tombol Aksi -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
