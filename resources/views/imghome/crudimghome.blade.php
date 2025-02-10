<x-layout>
    <!-- Menampilkan Notifikasi -->
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
                    <div class="modal-body">
                        <form action="{{ route('imghome.store') }}" method="post" class="p-3 bg-light rounded shadow-sm" enctype="multipart/form-data">
                            @csrf

                            <!-- Input Name -->
                            <div class="form-group mb-3">
                                <label for="name" class="form-label fw-bold">Name:</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>

                            <!-- Upload Gambar -->
                            <div class="form-group mb-3">
                                <label for="image" class="form-label fw-bold">Upload Gambar:</label>
                                <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
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

        <!-- Tabel Data -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Example
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($imghomes as $imghome)
                            <tr>
                                <td>{{ $imghome->id }}</td>
                                <td>{{ $imghome->name }}</td>
                                <td>
                                    <img src="{{ Storage::url($imghome->imghome) }}" alt="Image {{ $imghome->id }}" width="50">
                                </td>
                                <td>
                                    <!-- Edit Button -->
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $imghome->id }}">Edit</button>

                                    <!-- Delete Button -->
                                    <form action="{{ route('imghome.destroy', $imghome->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $imghome->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $imghome->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <form action="{{ route('imghome.update', $imghome->id) }}" method="POST" class="p-3 bg-light rounded shadow-sm" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <!-- Input Name -->
                                                <div class="form-group mb-3">
                                                    <label for="name{{ $imghome->id }}" class="form-label fw-bold">Name:</label>
                                                    <input type="text" name="name" id="name{{ $imghome->id }}" class="form-control" value="{{ $imghome->name }}">
                                                </div>

                                                <!-- Upload Gambar -->
                                                <div class="form-group mb-3">
                                                    <label for="image{{ $imghome->id }}" class="form-label fw-bold">Update Gambar:</label>
                                                    <input type="file" name="image" id="image{{ $imghome->id }}" class="form-control" accept="image/*">
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
