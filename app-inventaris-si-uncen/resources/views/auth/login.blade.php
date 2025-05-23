<!DOCTYPE html> 
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login | {{  env('APP_NAME') }}</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{  env('APP_LOGO') }}">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-primary" style="background-image: url('{{ asset('image/bg-library-2.png') }}'); background-size: cover; background-position: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none  bg-login-image d-flex justify-content-center align-items-center">
                                <img src="{{  env('APP_LOGO') }}" alt="logo uncen" class="w-75">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <div class="mb-3">{{  env('APP_NAME') }}</div>
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                    </div>

                                    <form method="POST" action="{{ route('login') }}" class="user">
                                    @csrf
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="form-group">
                                            <label for="email" class="form-label">Email</label>
                                            <input id="email" type="email" name="email" class="form-control form-control-user" autofocus>
                                            @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror   
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="form-label">Password</label>
                                            <input id="password" type="password" name="password" class="form-control form-control-user">
                                            @error('password')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror   
                                        </div>
                                        <hr>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Log in</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>
</html>