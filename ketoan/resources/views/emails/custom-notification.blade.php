<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'Thông báo từ hệ thống' }}</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f8f9fa; margin: 0; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; padding: 30px;">
        <h2 style="color: #0d6efd; text-align: center;">{{ $title ?? '🔔 Thông báo mới!' }}</h2>

        @if (!empty($greeting))
        <p>{{ $greeting }}</p>
        @endif

        <div style="margin: 20px 0;">
            {!! $content ?? '<p>Không có nội dung thông báo.</p>' !!}
        </div>

        @if (!empty($actionText) && !empty($actionUrl))
        <p style="text-align: center; margin: 30px 0;">
            <a href="{{ $actionUrl }}" style="background-color: #0d6efd; color: #fff; text-decoration: none; padding: 12px 20px; border-radius: 5px; display: inline-block;">
                {{ $actionText }}
            </a>
        </p>
        @endif

        <hr style="margin-top: 40px;">
        <p style="font-size: 12px; color: #6c757d; text-align: center;">Cảm ơn bạn đã tin tưởng và sử dụng dịch vụ của chúng tôi.</p>
    </div>
</body>
</html>
