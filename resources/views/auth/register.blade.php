
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS-->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/sign-in/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <div class="col-lg-3">
        <main class="form-registration">
            <h1 class="h3 mb-3 font-weight-normal">Registration {{ config("app.name")}}</h1>
            <form class="form-registration" method="POST" action="{{ route('register.custom') }}">
              @csrf    
              <div class="form-floating">
                  <input type="text" name="name" id="inputName" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                  placeholder="Please insert your name" value="{{old('name')}}" required autofocus>
                  <label for="inputEmail" class="sr-only">Name</label>
                  @if($errors->has('name'))
                      <div class="invalid-feedback">
                          {{ $errors->first('name') }}
                      </div>
                  @endif
              </div>    
      
              <div class="form-floating">
                  <input type="email" name="email" id="inputEmail" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                  placeholder="name@example.com" required autofocus value="{{old('email')}}">
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
              <button class="btn btn-lg btn-primary btn-block mt-2" type="submit">Register</button>
              <small class="d-block text-center mt-3">Already Registered?
                <a href="/login">Login</a>
              </small>
            </form>
        </main>
    </div>
  </body>
</html>
