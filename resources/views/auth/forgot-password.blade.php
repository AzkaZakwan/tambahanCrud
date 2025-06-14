<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Lupa Password</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white">
  <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="bg-black p-5 rounded" style="width: 100%; max-width: 400px;">
      <h3 class="text-center mb-4">Lupa Password</h3>

      @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Kirim Link Reset</button>
      </form>

      <div class="text-center mt-3">
        <a href="{{ route('login') }}" class="text-decoration-none text-info">Kembali ke login</a>
      </div>
    </div>
  </div>
</body>
</html>
