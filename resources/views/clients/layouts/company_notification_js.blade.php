<script src="{{ asset('plugins/pusher-js/dist/web/pusher.js') }}"></script>
{!! Form::hidden('token', Auth::check() ? Auth::user()->token : '', ['id' => 'urtk']) !!}
<script src="{{ asset('assets/clients/notification.js') }}"></script>
