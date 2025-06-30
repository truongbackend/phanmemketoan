<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Khiếu nại mới từ người dùng</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f8f9fa; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; padding: 20px;">
        <h2 style="color: #dc3545; text-align: center;">📢 Khiếu nại mới được gửi!</h2>

        <p>Xin chào <strong>Admin</strong>,</p>

        <p>Một người dùng vừa gửi khiếu nại trên hệ thống. Dưới đây là chi tiết:</p>

        <ul>
            <li><strong>Người gửi:</strong> {{ $complaint->user->name }} ({{ $complaint->user->email }})</li>
            <li><strong>Mã đơn hàng:</strong> {{ $complaint->order_code ?? 'Không có' }}</li>
            <li><strong>Ngày gửi:</strong> {{ $complaint->created_at->format('d/m/Y H:i') }}</li>
        </ul>

        <h3 style="color: #0d6efd;">Nội dung khiếu nại:</h3>
        <div style="background-color: #f1f1f1; padding: 15px; border-radius: 5px; font-size: 16px;">
            {{ $complaint->content }}
        </div>

        <p style="text-align: center; margin: 30px 0;">
            <a href="{{ url('/admin/complaints/'.$complaint->id) }}" style="background-color: #0d6efd; color: #fff; text-decoration: none; padding: 12px 20px; border-radius: 5px; display: inline-block;">
                Xem khiếu nại chi tiết
            </a>
        </p>

        <hr>
        <p style="font-size: 12px; color: #6c757d; text-align: center;">
            Cảm ơn bạn đã sử dụng hệ thống quản trị của chúng tôi.
        </p>
    </div>
</body>
</html>
