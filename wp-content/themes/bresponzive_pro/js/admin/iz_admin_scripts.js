(function ($) {
    $(document).ready(function () {
        $('.list-champions .iz-champion a').click(function (e) {
            e.preventDefault();
            $('.list-champions .iz-champion').removeClass('ch-select');
            $(this).parent('.iz-champion').addClass('ch-select');
            var ch_id = $(this).attr('data-id');
            var ch_name = $(this).attr('title');
            $('#guide-champion').val(ch_id);
        });
    });
})(jQuery);
