<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Login Page</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #E16026;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .logo{
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .logo img{
            height: 50px;
        }
        .login-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 360px;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .login-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background: #0072ff;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .login-container input[type="submit"]:hover {
            background: #0056d4;
        }
        .login-container .forgot-password {
            text-align: center;
            margin-top: 15px;
        }
        .login-container .forgot-password a {
            color: #0072ff;
            text-decoration: none;
        }
        .login-container .forgot-password a:hover {
            text-decoration: underline;
        }
        @media (max-width: 500px) {
            .login-container {
                padding: 15px;
            }
        }
    </style>
</head>
<body>

  
<div class="login-container">
    @if(session()->has('failed'))   
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
     {{ session('failed')}}
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>
 @endif 
    <div class="logo">
        <img src="{{ asset('foto/' . $general->logo) }}" alt="">
    </div>
    <form action="{{ route('login.proses') }}" method="POST">
        @csrf
        <input type="text" placeholder="Username" class="@error('username') is-invalid @enderror" name="username">
        @error('username')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <input type="password" placeholder="Password" name="password">
      

        <input type="submit" value="Login">
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
