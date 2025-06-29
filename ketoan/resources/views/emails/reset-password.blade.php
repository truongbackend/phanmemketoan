<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Đặt lại mật khẩu thành công</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f8f9fa; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; padding: 20px;">
        <h2 style="color: #dc3545; text-align: center;">🔑 Mật khẩu của bạn đã được đặt lại!</h2>

        <p>Xin chào <strong>{{ $user->name }}</strong>,</p>

        <p>Chúng tôi đã đặt lại mật khẩu cho tài khoản của bạn. Dưới đây là mật khẩu mới:</p>

        <p style="background-color: #f1f1f1; padding: 15px; border-radius: 5px; font-size: 18px; text-align: center; word-break: break-all;">
            <strong>{{ $newPassword }}</strong>
        </p>

        <p>Vui lòng sử dụng mật khẩu này để đăng nhập, và hãy đổi mật khẩu ngay sau khi đăng nhập để đảm bảo an toàn cho tài khoản.</p>

        <p style="text-align: center;">
            <a href="{{ url('/login') }}" style="background-color: #dc3545; color: #fff; text-decoration: none; padding: 12px 20px; border-radius: 5px; display: inline-block;">
                Đăng nhập ngay
            </a>
        </p>

        <hr>
        <p style="font-size: 12px; color: #6c757d;">Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng liên hệ chúng tôi ngay để được hỗ trợ.</p>
        <p style="font-size: 12px; color: #6c757d;">Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.</p>
    </div>
</body>
</html>
