

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('dist/css/login.css') }}">

    <title>Login</title>
</head>
<body style="background-image: url(dist/img/bg-pattern.png); color:">
    
    <section class="ftco-section">
        <div class="container">
        <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
        <div class="login-wrap p-4 p-md-5">
   
            <div >
            <center>
                <img src="{{ url('dist/img/user.png') }}" alt="" width="90">
            </center>
            </div>
        <h3 class=" mt-3 font-weight-bold" style="color: #4e7c5b;">Form Login</h3>
        <hr>
        {{-- <small class="font-italic">Welcome Back! Please Login To Your Account</small> --}}
        @if(Session::has('status'))
            <div class="alert alert-danger">
                {{ Session::get('message') }}
            </div>
        @endif
        <form method="POST" action="{{ url('/login') }}" class="login-form">
        @csrf
        <div class="form-group">
        <label>Email</label>
        <input type="text" name="email" class="form-control rounded-left" placeholder="Masukkan Email" required>
        </div>
        <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control rounded-left" placeholder="*********" required>
        </div>
        <div class="form-group d-md-flex">
        <div class="w-50">
        {{-- <label class="checkbox-wrap checkbox-primary">Remember Me
        <input type="checkbox" checked>
        <span class="checkmark"></span>
        </label> --}}
        </div>
        {{-- <div class="w-50 text-md-right">
        <a href="#">Forgot Password</a>
        </div> --}}
        </div>
        <div class="form-group">
        <button type="submit" class="btn btn-primary rounded submit p-3 px-5" style="background-color: #4e7c5b !important; border:1px solid #4e7c5b !important; ">Login</button>
        </div>
        </form>
        </div>
        </div>
        </div>
        </div>
        </section>
    

</body>
</html>