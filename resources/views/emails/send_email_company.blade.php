@extends('emails.mailMaster')
@section('contentMail')
    Hi, <b>{{ $companyName }}</b>
    <p>
        Candidate <a href="{{ $candidateLink }}">{{ $candidateName }}</a> has applied for <a href="{{ $linkJob }}">{{ $jobName }}</a>.
    </p>
@endsection

