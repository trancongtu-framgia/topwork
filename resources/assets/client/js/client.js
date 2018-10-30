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
function getJobByCategory(category) {
    var box = $(category);
    if (box.is(':checked')) {
        var group = 'input:checkbox[name=\'' + box.attr('name') + '\']';
        $(group).prop('checked', false);
        box.prop('checked', true);
        getJob(box.val());
    } else {
        box.prop('checked', false);
    }

}

function getJob(categoryId) {
    $.ajax({
        url: route('job.getJobByCategory'),
        type: 'GET',
        data: {categoryId: categoryId},
        success: function (data) {
            $('#conten-job').html(data);
        }
    });
}

$( document ).ready(function() {
    $('#btn-search-client').click(function () {
        $('#form_search').submit();
    });
    //search
    var engine2 = new Bloodhound({
        remote: {
            url: route('home.searchJob') + '?value=%QUERY%',
            wildcard: '%QUERY%'
        },
        datumTokenizer: Bloodhound.tokenizers.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace
    });

    $('#search-input').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, [
        {
            source: engine2.ttAdapter(),
            name: 'skill',
            display: function(data) {
                return data.name;
            },
            templates: {
                suggestion: function (data) {
                    return '<a href="javascript:void(0)" class="list-group-item">' + data.name + '</a>';
                }
            }
        }
    ]);

});
