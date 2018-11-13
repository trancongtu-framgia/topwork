<script src="{{ asset('plugins/pusher-js/dist/web/pusher.js') }}"></script>
{!! Form::hidden('token', session()->has('authenticated_user') ? Auth::user()->token : '', ['id' => 'urtk']) !!}
<script src="{{ asset('assets/clients/notification.js') }}"></script>
