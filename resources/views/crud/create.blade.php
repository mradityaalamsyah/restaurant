<x-layout>

        <div>
            <section class="p-3">
    
                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-primary newUser" data-bs-toggle="modal" data-bs-target="#userForm">Create Menu <i class="bi bi-people"></i></button>
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped table-hover mt-3 text-center table-bordered">
        
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>stock</th>
                                </tr>
                            </thead>
        
                            <tbody id="data"></tbody>
        
                        </table>
                    </div>
                </div>
        
            </section>
        
        
            <!--Modal Form-->
            <div class="modal fade" id="userForm">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
        
                        <div class="modal-header">
                            <h4 class="modal-title">Buat Menu</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
        
                        <div class="modal-body">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
        
                            <form action="{{ route('menu.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card imgholder">
                                    <label for="imgInput" class="upload">
                                        <input type="file" name="" id="imgInput">
                                        <i class="bi bi-plus-circle-dotted"></i>
                                    </label>
                                    <img src="./image/Profile Icon.webp" alt="" width="200" height="200" class="img">
                                </div>
        
                                <div class="inputField">
                                    <div>
                                        <label for="name">Nama:</label>
                                        <input type="text" name="name" id="name" required">
                                    </div>
                                    <div>
                                        <label for="category">Kategori:</label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="" selected disabled>---PILIH---</option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="desc">Deskripsi:</label>
                                        <input type="text" name="desc" id="desc" required>
                                    </div>
                                    <div>
                                        <label for="harga">Harga:</label>
                                        <input type="number" name="harga" id="harga" required>
                                    </div>
                                    <div>
                                        <label for="stock">Stock:</label>
                                        <input type="number" name="stock" id="stock" minlength="11" maxlength="11" required>
                                    </div>
                                </div>
        
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary submit">Submit</button>
                                </div>
                            </form>
                        </div>
        
                    </div>
                </div>
            </div>
        
            <!--Read Data Modal-->
            <div class="modal fade" id="readData">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
        
                        <div class="modal-header">
                            <h4 class="modal-title">Profile</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
        
                        <div class="modal-body">
        
                            <form action="#" id="myForm">
        
                                <div class="card imgholder">
                                    <img src="./image/Profile Icon.webp" alt="" width="200" height="200" class="showImg">
                                </div>
        
                                <div class="inputField">
                                    <div>
                                        <label for="name">Name:</label>
                                        <input type="text" name="" id="showName" disabled>
                                    </div>
                                    <div>
                                        <label for="age">Age:</label>
                                        <input type="number" name="" id="showAge" disabled>
                                    </div>
                                    <div>
                                        <label for="city">City:</label>
                                        <input type="text" name="" id="showCity" disabled>
                                    </div>
                                    <div>
                                        <label for="email">E-mail:</label>
                                        <input type="email" name="" id="showEmail" disabled>
                                    </div>
                                    <div>
                                        <label for="phone">Number:</label>
                                        <input type="text" name="" id="showPhone" minlength="11" maxlength="11" disabled>
                                    </div>
                                    <div>
                                        <label for="post">Post:</label>
                                        <input type="text" name="" id="showPost" disabled>
                                    </div>
                                    <div>
                                        <label for="sDate">Start Date:</label>
                                        <input type="date" name="" id="showsDate" disabled>
                                    </div>
                                </div>
        
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    

</x-layout>