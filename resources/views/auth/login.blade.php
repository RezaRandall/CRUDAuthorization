
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Bootstrap core CSS -->
    <!-- <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/sign-in/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <div class="col-lg-3">

    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}        
    </div>
    @endif

    @if(session()->has('loginErr'))
    <div class="alert alert-danger" role="alert">
        {{ session('loginErr') }}        
    </div>
    @endif

      <main class="form-login">
        <h1 class="h3 mb-3 font-weight-normal">Login {{ config("app.name")}}</h1>
        <form class="form-signin" method="POST" action="/customLogin">
         @csrf          
         <div class="form-floating">
           <input type="email" name="email" id="inputEmail" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
           placeholder="name@example.com" required autofocus>
           <label for="inputEmail" class="sr-only">Email address</label>
           @if($errors->has('email'))
               <div class="invalid-feedback">
                   {{ $errors->first('email') }}
               </div>
           @endif
         </div>
    
         <div class="form-floating">          
           <input type="password" name="password" id="inputPassword" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
           placeholder="Password" required autofocus >
           <label for="inputPassword" class="sr-only">Password</label>
           @if($errors->has('password'))
               <div class="invalid-feedback">
                   {{ $errors->first('password') }}
               </div>
           @endif
          </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
            <small class="d-block text-center mt-3">Not Registered?
              <a href="/register">Register Now!</a>
            </small>
        </form>
      </main>
    </div>
  </body>
</html>
