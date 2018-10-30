<!DOCTYPE html>
<html>
<head>
    <title>{{ __('XIN CHÀO') }}</title>
</head>
<body>
<h1>{{ __('Chào mừng ') . $candidateName . __(' đến với TOPWORK') }}</h1>
<br>
<p>
    {{ __('Bạn vừa ứng tuyển công việc ') }}
    <span class="send_mail_content">{{ $nameJob }}</span>
    {{ __(' thành công') }}
    {{  __('công ty ') }}
    <span class="send_mail_content">{{ $companyName }}</span>
    {{ __(' sẽ kiểm duyệt và liên hệ lớn nhất có thế') }}
    <a href="{{ $link }}">{{ __('Chi tiết xem TẠI ĐÂY')  }} </a>
       <p> {{ __('Xin cảm ơn!') }} </p>
</p>
</body>
</html>
