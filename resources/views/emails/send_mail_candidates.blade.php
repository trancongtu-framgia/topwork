@extends('emails.mailMaster')
@section('contentMail')
Hi, <b>{{ $candidateName }}</b>
<p>
    You have just applied to the <a href="{{ $linkJob }}">{{ $nameJob }}</a> at <a href="{{ $linkCompany }}">{{ $companyName }}</a>.
</p>
<p>
    The <a href="{{ $linkCompany }}">{{ $companyName }}</a> will inform you soon.
</p>
@endsection
