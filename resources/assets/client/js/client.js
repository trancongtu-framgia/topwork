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

function getJobBySalary(salary) {
    var box = $(salary);
    if (box.is(':checked')) {
        var group = 'input:checkbox[name=\'' + box.attr('name') + '\']';
        $(group).prop('checked', false);
        box.prop('checked', true);
    } else {
        box.prop('checked', false);
    }
}

$('.salaryCheckbox').change(function () {
    getJob(getJobBySalaryValue(), getJobByCategory());
});

function getJobBySalaryValue(){
    var salaryCheck = [];
    $('.salaryCheckbox:checked').each(function(i){
        salaryCheck[i] = $(this).val();
    });

    return salaryCheck;
}

$('.categoryCheckbox').change(function () {
    getJob(getJobBySalaryValue(), getJobByCategory());
});

function getJobByCategory() {
    var categoryCheck = [];
    $('.categoryCheckbox:checked').each(function(i){
        categoryCheck[i] = $(this).val();
    });

    return categoryCheck;
}

function showNotification(content, type) {
    notif({
        msg: '<b>' + content + '</b>',
        type: type
    });
}

function getNotification(lang, content, type) {
    if (lang == 'vi') {
        __message = ' thành công !';
    } else {
        __message = ' successfully !';
    }
    showNotification(content + __message, type);
}

function is_public_candidate(lang, content) {
    setupAjax();
    var token = $('#candidate_token').val();
    $.ajax({
        url: route('cadidate.changeStatus'),
        type: 'POST',
        data: {token:token},
        success: function (data) {
            if (data == 'true') {
                getNotification(lang, content, 'success');
            }
        }
    });
}

function setupAjax() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}

function changeJobStatus(lang, content) {
    var toggle = $('#change_job_status').val();
    var jobId = $('#hidden_job_id').val();
    var orginalLabel = $('#open_job').text();
    setupAjax();
    $.ajax({
        url: route('jobs.change_status'),
        type: 'POST',
        data: {id:jobId},
        success: function (data) {
            getNotification(lang, content, 'success');
        }
    })
}

function getJob(salary, categoryId) {
    $.ajax({
        url: route('job.getJobBySalaryCategory'),
        type: 'GET',
        data: {categoryId: categoryId, salary: salary},
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
function goBack() {
    window.history.back();
}
