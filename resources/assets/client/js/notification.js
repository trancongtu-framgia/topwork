var pusher = new Pusher('f25ed326d8b782516478', {
    cluster: 'ap1',
    forceTLS: true
});
var channel = pusher.subscribe('NewApplicationNotify');
channel.bind('new-application', function(data) {
    var token = $('#urtk').val();
    var notification = JSON.parse(data);
    if (token == notification.receiver_token) {
        showNotification(notification.content, 'success');
        var element =
            '<a id=\''+ notification.id +'\' class=\'notify_element_a\'>\n' +
            '   <div class=\'notify_element_unread\'>\n' +
            notification.content +
            '       <span class=\'pull-right\'>' + notification.created_at + '</span>\n' +
            '   </div>\n' +
            '</a>';
        $('#first_element').after(element);
        $('#' + notification.id).click(function(){
            changeNotificationStatus(
                notification.id,
                route('application.getDetailCandidate', {'token': notification.sender_token, 'jobId': notification.job_id})
            )
        });
        $('#' + notification.id).attr('href', 'javascript:void(0)');
        $('#noti_Button').html('<i class=\'fa fa-bell\' aria-hidden=\'true\'></i>').css('color', '#ffffff');
    }
});
