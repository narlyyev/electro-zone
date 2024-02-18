<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</head>

<body style="background: #007AFF;">
<div class="container-xl">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-12 col-md-7 col-lg-4">
            <div class="p-5 rounded">
                <main class="form-signin w-100">
                    <form action="{{ route('admin.login') }}" method="POST">
                        @csrf
                        <div class="text-center pb-4">
                            <img src="{{ asset('img/logo.svg') }}" alt="" class="img-fluid" style="width: 150px;">
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                   value="{{ old('phone') }}" name="phone" placeholder="6XXXXXXX">
                            <label for="phone">Phone</label>
                            <!-- error -->
                            @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" placeholder="password" name="password" value="{{ old('password') }}">
                            <label for="password">Password</label>
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button class="btn btn-outline-dark w-100 py-2 mt-3" type="submit">Sign in</button>
                    </form>
                </main>
            </div>
        </div>
    </div>
</div>
</body>

</html>