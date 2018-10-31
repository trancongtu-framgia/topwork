$(document).ready(function() {
    $('#job_skill_selector').select2({
        allowClear: true
    });
    $('#category_selector').select2({
        allowClear: true
    });
    $('.select2-search__field').css('height', '30px');

    $('#buttonBack').click(function () {
        window.history.back();
    })
});

$('#category_selector').change(function() {
    var categoryId = $('#category_selector').val();
    $.ajax({
        url: route('skills.getSkillByCategory'),
        type: 'GET',
        data: {categoryId:categoryId},
        success: function (data) {
            $('#job_skill_selector').empty();
            var listOption = '';
            $.each(data, function (i, item) {
                listOption += '<option value="' + item.id + '">' + item.name + '</option>'
            });
            $('#job_skill_selector').html(listOption);
        }
    })
});

