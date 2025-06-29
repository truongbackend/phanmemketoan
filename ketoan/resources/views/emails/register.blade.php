<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Đăng ký thành công</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f8f9fa; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; padding: 20px;">
        <h2 style="color: #0d6efd; text-align: center;">🎉 Chúc mừng bạn đã đăng ký thành công!</h2>
        <p>Xin chào <strong>{{ $user->name }}</strong>,</p>
        <p>Bạn đã đăng ký tài khoản thành công trên hệ thống của chúng tôi. Dưới đây là thông tin tài khoản:</p>
        <ul>
            <li><strong>Email:</strong> {{ $user->email }}</li>
            <li><strong>Ngày đăng ký:</strong> {{ now()->format('d/m/Y H:i') }}</li>
        </ul>
        <p>Bạn có thể đăng nhập ngay tại liên kết dưới đây:</p>
        <p style="text-align: center;">
            <a href="{{ url('/login') }}" style="background-color: #0d6efd; color: #fff; text-decoration: none; padding: 12px 20px; border-radius: 5px; display: inline-block;">
                Đăng nhập ngay
            </a>
        </p>
        <hr>
        <p style="font-size: 12px; color: #6c757d;">Cảm ơn bạn đã tin tưởng và sử dụng dịch vụ của chúng tôi.</p>
    </div>
</body>
</html>
