@extends('emails.mailMaster')
@section('contentMail')
    Hi, <b>{{ $name }}</b>
    <p>
        Your account has been created successfully!
    </p>
    <p>Please! <a href="{{ $link }}">Click here </a> to confirm your account.</p>
@endsection
