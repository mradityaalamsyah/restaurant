<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Register</title>
</head>
<body>
<div class="wrapper">
    <div class="container main">
        <div class="row">
            <div class="col-md-6 right">
                <div class="input-box">
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                    
                    <header>Register</header>
                    <form action="{{ route('admin.processRegister') }}" method="POST">
                        @csrf
                        <div class="input-field">
                            <input type="text" value="{{ old('name') }}" class="input @error('name') is-invalid @enderror" id="name" name="name" >
                            <label for="name">Name</label>
                            @error('name')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-field">
                            <input type="email" value="{{ old('email') }}" class="input @error('email') is-invalid @enderror" id="email" name="email" >
                            <label for="email">Email</label>
                            @error('email')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-field">
                            <input type="password" class="input @error('password') is-invalid @enderror" id="password" name="password" >
                            <label for="password">Password</label>
                            @error('password')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-field">
                            <input type="password" class="input @error('password_confirm') is-invalid @enderror" id="password_confirm" name="password_confirm" >
                            <label for="password">Confirm Password</label>
                            @error('password_confirm')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-field">
                            <input type="submit" class="submit" value="Create">
                        </div>
                        <div class="signin">
                            <span>Don't have an account? <a href="{{ route('order.crudorder') }}">Sign up here</a></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
