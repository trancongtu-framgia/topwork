<!DOCTYPE html>
<html>
<head>
    <title>{{ __('XIN CHÀO') }}</title>
</head>
<body>
<h1>{{ __('Xin chào ') . $companyName }}</h1>
<br>
<p>
    {{ __('Ứng cử viên') }}
    <span class="send_mail_content">{{ $candidateName }}</span>
    {{ __(' vừa mới ứng tuyển vào công việc') }}
    <span class="send_mail_content">{{ $jobName }}</span>
    {{  __(' của công ty.') }}
    {{ __(' Xin mời kiểm tra thông tin của ứng cử viên. Và phản hồi sớm nhất có thể') }}
    <a href="{{ $link }}">{{ __('Chi tiết xem TẠI ĐÂY') }} </a>
    <p> {{ __('Xin cảm ơn!') }} </p>
</p>
</body>
</html>
