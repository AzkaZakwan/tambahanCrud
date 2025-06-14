<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reset Password - Fivoy</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      padding: 40px;
      color: #333;
    }

    .email-container {
      background-color: #ffffff;
      border-radius: 8px;
      padding: 30px;
      max-width: 600px;
      margin: 0 auto;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .logo {
      text-align: center;
      margin-bottom: 20px;
    }

    .logo h1 {
      color: #4d6fff;
      font-size: 28px;
    }

    .content {
      line-height: 1.6;
    }

    .btn {
      display: inline-block;
      background-color: #4d6fff;
      color: #fff !important;
      text-decoration: none;
      padding: 12px 24px;
      border-radius: 6px;
      margin-top: 20px;
    }

    .footer {
      margin-top: 40px;
      font-size: 12px;
      color: #777;
      text-align: center;
    }

    a {
      color: #4d6fff;
    }
  </style>
</head>
<body>
  <div class="email-container">
    <div class="logo">
      <h1>Fivoy</h1>
    </div>

    <div class="content">
      <p>Halo,</p>

      <p>Kami menerima permintaan untuk mereset password akun Anda. Jika ini memang Anda, silakan klik tombol di bawah ini:</p>

      <p style="text-align: center;">
        <a href="{{ url('/reset-password?token=' . $token) }}" class="btn">Reset Password</a>
      </p>

      <p>Jika Anda tidak meminta reset password, abaikan email ini. Link reset hanya berlaku selama 60 menit.</p>

      <p>Terima kasih,<br>Tim Fivoy</p>
    </div>

    <div class="footer">
      &copy; {{ date('Y') }} Fivoy. All rights reserved.
    </div>
  </div>
</body>
</html>
