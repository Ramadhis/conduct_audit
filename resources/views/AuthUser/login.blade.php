@include('include.header')

<body class="text-center">
  <div class="container ">
    <div class="row d-flex justify-content-center">
      <div class="col-md-4" style="margin-top:80px;">
        <div class="card">
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <h1 class="h3 mb-3 font-weight-normal mb-5 mt-3">Login Form</h1>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required
              autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control mt-3" name="password" placeholder="Password"
              required>
            @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
            <label class="form-check">
              <input class="form-check-input" type="checkbox" value="remember-me" name="remember-me" checked>
              <span class="form-check-label">
                Remember me next time
              </span>
            </label>
            <button class="btn btn-lg btn-primary btn-block mt-3" type="submit">Login</button>
            <p class="mt-3 mb-3 text-muted">&copy; 2024</p>
          </form>
        </div>
      </div>
    </div>

  </div>
</body>