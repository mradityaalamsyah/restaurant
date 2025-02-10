<!-- resources/views/menu/index.blade.php -->
<x-layout>
    <div class="container-fluid px-4">
        <!-- Menampilkan Notifikasi -->
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                {{ Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Tombol Tambah Data -->
        <button class="btn btn-primary mb-3 mt-3" data-bs-toggle="modal" data-bs-target="#addMenuModal">Tambah Data</button>

        <!-- Modal Tambah Data -->
        <div class="modal fade" id="addMenuModal" tabindex="-1" aria-labelledby="addMenuLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ route('menu.store') }}" method="post" class="p-3 bg-light rounded shadow-sm" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Nama -->
                            <div class="form-group mb-3">
                                <label for="name" class="form-label fw-bold">Nama :</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama" required>
                            </div>
                            
                            <!-- Kategori -->
                            <div class="form-group mb-3">
                                <label for="category" class="form-label fw-bold">Kategori:</label>
                                <select name="category" id="category" class="form-control" required>
                                    <option value="" selected disabled>Pilih Kategori</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Upload Gambar -->
                            <div class="form-group mb-3">
                                <label for="image" class="form-label fw-bold">Upload Gambar:</label>
                                <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
                            </div>

                            <!-- Deskripsi -->
                            <div class="form-group mb-3">
                                <label for="desc" class="form-label fw-bold">Deskripsi:</label>
                                <input type="text" name="desc" id="desc" class="form-control" placeholder="Masukkan deskripsi" required>
                            </div>

                            <!-- Harga -->
                            <div class="form-group mb-3">
                                <label for="harga" class="form-label fw-bold">Harga:</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="harga" id="harga" class="form-control" placeholder="Masukkan harga" required>
                                </div>
                            </div>

                            <!-- Stock -->
                            <div class="form-group mb-3">
                                <label for="stock" class="form-label fw-bold">Stock:</label>
                                <input type="number" name="stock" id="stock" class="form-control" placeholder="Masukkan jumlah stock" required>
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

        <!-- Tabel Data Menu -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Menu
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Gambar</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menus as $menu)
                            <tr>
                                <td>{{ $menu->name }}</td>
                                <td>{{ $menu->category->name }}</td>
                                <td>
                                    <img src="{{ Storage::url($menu->img) }}" alt="{{ $menu->name }}" width="50">
                                </td>                                
                                <td>{{ $menu->desc_produk }}</td>
                                <td>Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                                <td>{{ $menu->stock }}</td>
                                <td>
                                    <!-- Update Button -->
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $menu->id }}">Edit</button>

                                    <!-- Delete Button -->
                                    <form action="{{ route('menu.destroy', $menu->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $menu->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $menu->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <form action="{{ route('menu.update', $menu->id) }}" method="POST" class="p-3 bg-light rounded shadow-sm" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                
                                                <!-- Nama -->
                                                <div class="form-group mb-3">
                                                    <label for="name{{ $menu->id }}" class="form-label fw-bold">Nama :</label>
                                                    <input type="text" name="name" id="name{{ $menu->id }}" class="form-control" value="{{ $menu->name }}" required>
                                                </div>
                                                
                                                <!-- Kategori -->
                                                <div class="form-group mb-3">
                                                    <label for="category{{ $menu->id }}" class="form-label fw-bold">Kategori:</label>
                                                    <select name="category" id="category{{ $menu->id }}" class="form-control" required>
                                                        @foreach ($categories as $item)
                                                            <option value="{{ $item->id }}" {{ $item->id == $menu->category_id ? 'selected' : '' }}>
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Upload Gambar -->
                                                <div class="form-group mb-3">
                                                    <label for="image{{ $menu->id }}" class="form-label fw-bold">Upload Gambar:</label>
                                                    <input type="file" name="image" id="image{{ $menu->id }}" class="form-control" accept="image/*">
                                                </div>

                                                <!-- Deskripsi -->
                                                <div class="form-group mb-3">
                                                    <label for="desc{{ $menu->id }}" class="form-label fw-bold">Deskripsi:</label>
                                                    <input type="text" name="desc" id="desc{{ $menu->id }}" class="form-control" value="{{ $menu->desc_produk }}" required>
                                                </div>

                                                <!-- Harga -->
                                                <div class="form-group mb-3">
                                                    <label for="harga{{ $menu->id }}" class="form-label fw-bold">Harga:</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">Rp</span>
                                                        <input type="number" name="harga" id="harga{{ $menu->id }}" class="form-control" value="{{ $menu->price }}" required>
                                                    </div>
                                                </div>

                                                <!-- Stock -->
                                                <div class="form-group mb-3">
                                                    <label for="stock{{ $menu->id }}" class="form-label fw-bold">Stock:</label>
                                                    <input type="number" name="stock" id="stock{{ $menu->id }}" class="form-control" value="{{ $menu->stock }}" required>
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
