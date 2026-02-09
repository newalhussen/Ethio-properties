<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login - Hospital Management</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Nunito', sans-serif;
      background: linear-gradient(135deg, #f0f4f7 0%, #ffffff 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-card {
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.15);
      overflow: hidden;
      max-width: 900px;
      width: 100%;
      display: flex;
      background: #fff;
    }

    .login-left {
      background: #3fbbc0;
      color: white;
      padding: 50px 40px;
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .login-left img {
      max-width: 120px;
      margin-bottom: 30px;
    }

    .login-left h2 {
      font-weight: 700;
      font-size: 28px;
      margin-bottom: 20px;
    }

    .login-left p {
      font-size: 16px;
      text-align: center;
    }

    .login-right {
      flex: 1;
      padding: 50px 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .login-right h3 {
      font-weight: 700;
      margin-bottom: 30px;
      color: #333;
    }

    .form-control:focus {
      border-color: #3fbbc0;
      box-shadow: 0 0 0 0.2rem rgba(63,187,192,0.25);
    }

    .btn-login {
      background-color: #3fbbc0;
      border: none;
    }

    .btn-login:hover {
      background-color: #36a1a5;
    }

    .text-center a {
      color: #3fbbc0;
      text-decoration: none;
    }

    .text-center a:hover {
      text-decoration: underline;
    }

    @media(max-width: 768px) {
      .login-card {
        flex-direction: column;
      }
      .login-left, .login-right {
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>
  <div class="login-card">
    <!-- Left Side -->
    <div class="login-left">
      
      <h2>Welcome Admin</h2>
      <p>Access your hospital management dashboard and manage everything with ease.</p>
    </div>

    <!-- Right Side (Form) -->
    <div class="login-right">
      <h3>Admin Login</h3>

      @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
      @endif

      <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="remember" name="remember">
          <label class="form-check-label" for="remember">Remember me</label>
        </div>

        <button type="submit" class="btn btn-login w-100 mb-3">Login</button>
        <p class="text-center"><a href="#">Forgot your password?</a></p>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
