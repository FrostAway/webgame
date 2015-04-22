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
        
//        
//        $('#fl_champion_indexchecklist .popular-category input[type=checkbox]').prop('checked', true);
//        var last = $('#fl_champion_indexchecklist .popular-category:last input[type=checkbox]');
//        if(last.is(":cheked")){
//            
//        }else{
//            last.prop('checked', false);
//        }
//        
        
        //talent tax
        
        
        
        
        
    });
})(jQuery);
