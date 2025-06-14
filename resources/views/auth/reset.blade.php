<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password - Fivoy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #000;
            color: white;
        }
        .reset-container {
            min-height: 100vh;
        }
        .form-box {
            background-color: #111;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.05);
        }
        .form-control {
            background-color: #222;
            border: none;
            color: white;
        }
        .form-control:focus {
            background-color: #222;
            color: white;
            box-shadow: none;
        }
        .btn-dark-custom {
            background-color: #2b2b2b;
            color: white;
        }
        .btn-dark-custom:hover {
            background-color: #3b3b3b;
        }
    </style>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center reset-container">
    <div class="form-box w-100" style="max-width: 400px;">
        <h2 class="text-center mb-4">Reset Password</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" name="password" id="password" class="form-control" required minlength="6">
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-dark-custom w-100">Reset Password</button>
        </form>
    </div>
</div>
</body>
</html>
