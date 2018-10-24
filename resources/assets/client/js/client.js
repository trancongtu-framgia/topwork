/*đổi ngôn ngữ*/
function changeLang(url) {
    var activeUrl = url + '/change-lang/' + $('#change_lang').val();
    window.location.href = activeUrl;
}

function logout(content, cancel, ok) {
    $.confirm({
        title:"<span style='color: #23c0e9;font-weight: bold;font-size: 24px;'>TopWork</span>",
        content: content,
        buttons: {
            Oke: {
                btnClass: 'btn-blue',
                text: ok,
                action: function () {
                    $('#logout-form').submit();
                }
            },
            Cancel: {
                text: cancel,
            }
        }
    });
}
