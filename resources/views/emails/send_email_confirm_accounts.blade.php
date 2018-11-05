<!DOCTYPE html>
<html>
<head>
    <title>{{ __('Wellcome') }}</title>
</head>
<body>
<h1>{{ __('Wellcome ') . $name }}</h1>
<br>
<p>
    {{ __('You have just registed account success!') }}
    {{ __('Please!Click here to confirm your account') }}
    <a href="{{ $link }}">{{ __('CONFIRM')  }} </a>
<p> {{ __('Thank  you') }} </p>
</p>
</body>
</html>
