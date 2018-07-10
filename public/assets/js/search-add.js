$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('focus', '#search-input-1', function (e) {
        $(this).attr('autocomplete', 'off');
    });
    $(document).on('keyup', '#search-input-1', function (e) {
        e.preventDefault();
        
        var key = $('#search-input-1').val();
        var route = $('.hide').data('route');
        var teamId = $(this).data('team-id');
        $.ajax({
            dataType: "json",
            url: route,
            type : "GET",
            data: {
                keyword : key,
                team_id : teamId
            },
            success: function (result) {
                if (result.success) {
                    $('.search-area').html(result.html);
                    if (result.keyword == null) {
                        $('.search-area').empty();
                    }
                }
                if (result.fail) {
                    $('.search-area').empty();
                }
            },
        });
    });
});