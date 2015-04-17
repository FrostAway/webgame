(function ($) {
    $(document).ready(function () {
        $('.new-guide-form .list-champions .iz-champion a').click(function (e) {
            e.preventDefault();
            $('.list-champions .iz-champion').removeClass('ch-select');
            $(this).parent('.iz-champion').addClass('ch-select');
            var ch_id = $(this).attr('data-id');
            var ch_name = $(this).attr('title');
            $('#guide-champion').val(ch_id);
        });

        function index_slider() {
            $('.detail-talent .index-info #range').slider({
                range: "min",
                max: 30,
                min: 1,
                step: 1,
                slide: function (event, ui) {
                    $('.detail-talent .list-index .iz-index').each(function (index) {
                        var addlevel = parseFloat($(this).find('.iz-add-level').val());
                        var value = parseInt($(this).find('.iz-init-value').val());
                        $(this).find('.value').text((value + addlevel * parseInt(ui.value)).toFixed(1));
                    });
                    $('#range-value').html(ui.value);
                }
            });
        }
        index_slider();

        //talent
        function talent() {
            $('.talent-image .talents .level a').click(function (e) {
                e.preventDefault();
                var thisa = $(this).parent('.level');
                thisa.find('a').removeClass('active');
                thisa.find('a').addClass('none');
                $(this).removeClass('none');
                $(this).addClass('active');

                var index = $(this).attr('data-index');
                var name = $(this).attr('data-name');
                var iskill = $(this).attr('data-num');
                var term = $(this).attr('data-term');

                thisa.find('.none').each(function (i, value) {
                    var none_term = $(this).attr('data-term');
                    var none_iskill = $(this).attr('data-num');
                    $('.list-skill #skill-' + none_iskill + ' .info .add-text #tl-add-' + none_term).remove();
                    $('.list-skill #skill-' + none_iskill + ' .info .description #tl-desc-' + none_term).remove();
                });

                thisa.find('.ind').html('(' + index + ')');

                var desc = '<div class="desc" id="tl-desc-' + term + '">[<span>' + name + '</span>] ' + $(this).attr('data-title') + '</div>';
                var add_text = '<span id="tl-add-' + term + '">[' + name + ']</span> ';

                if ($('.list-skill #skill-' + iskill + ' .info .add-text #tl-add-' + term).length > 0) {
                } else {
                    $('.list-skill #skill-' + iskill + ' .info .description').append(desc);
                    $('.list-skill #skill-' + iskill + ' .info .add-text').append(add_text);
                }
            });
            
            $('.list-skill .iz-skill .info .open-close').click(function () {
                var desc = $(this).closest('.info').find('.description');
                if (desc.css('display') === 'none') {
                    $('.list-skill .iz-skill .info .description').slideUp();
                    $('.list-skill .iz-skill .info .open-close').html('[+]');
                    desc.slideDown();
                    $(this).html('[-]');
                } else {
                    desc.slideUp();
                    $(this).html(['[+]']);
                }
            });
            
            //talent
            $('#reset-talent').click(function(e){
                e.preventDefault();
                $('.list-skill .iz-skill .info .description').slideUp();
                    $('.list-skill .iz-skill .info .open-close').html('[+]');
                    
                    $('.talent-image .talents .level a').removeClass('active');
                    $('.talent-image .talents .level a').removeClass('none');
                    $('.talent-image .talents .level .ind').html('(0)');
                    
                    $('.list-skill .iz-skill .info .description .desc').remove();
                    $('.list-skill .iz-skill .info .add-text span').remove();
            });
            
            
        $('.talent-image .talents .level a').hover(function () {   
            var text_tooltip = $(this).find('.tl-tooltip').html();
            $('<div class="ch-tooltip tl-tooltip"></div>').html(text_tooltip).appendTo('body').fadeIn(300);
        }, function () {
            $('.ch-tooltip').remove();
        }).mousemove(function (e) {
            var mouseX = e.pageX;
            var mouseY = e.pageY;
            $('.ch-tooltip').css({top: mouseY - 100, left: mouseX + 30});
        });
        }
        talent();

        // champion talent select
        $('#list-champions .iz-champion:first').addClass('ch-select');
        $('#list-champions .iz-champion a').click(function (e) {
            e.preventDefault();
            $('#list-champions .iz-champion').removeClass('ch-select');
            $(this).parent('.iz-champion').addClass('ch-select');
            var load_url = params.talent_url;
            var ch_id = $(this).attr('data-id');
            $('#talent-loading').fadeIn(200);
            $('#load-talent-detail .detail-talent').hide('slide', {direction: 'down'}, 500);

            $('#load-talent-detail').load(load_url, {champion_id: ch_id}, function () {
                $('#talent-loading').fadeOut(0);
                index_slider();
                talent();
            });
        });



        $('#heroes .iz-champion .wrap').hover(function () {
//            $('<div class="loadding"></div>').html('Loadding .....').appendTo('body').fadeIn(0);
//            $.ajax({
//                url: params.ajaxurl,
//                type: 'POST',
//                data: {
//                    action: 'champion_tooltip',
//                    ch_id: $(this).find('a').attr('data-id')
//                },
//                success: function(data){
//                    $('<div class="ch-tooltip"></div>').html(data).appendTo('body').fadeIn(100);
//                }
//            });
            var text_tooltip = $(this).parent('.iz-champion').find('.text-tooltip').html();
            $('<div class="ch-tooltip"></div>').html(text_tooltip).appendTo('body').fadeIn(300);
        }, function () {
            $('.ch-tooltip').remove();
        }).mousemove(function (e) {
            var mouseX = e.pageX;
            var mouseY = e.pageY;
            $('.ch-tooltip').css({top: mouseY - 100, left: mouseX + 30});
        });

        $('#heroes .iz-champion .wrap').click(function () {
            var link = $(this).find('a').attr('href');
            window.location.href = link;
        });


        //galery slide
        $('.ch-galleries').bxSlider({
            slideWidth: 110,
            minSlides: 4,
            maxSlides: 4,
            slideMargin: 10,
            moveSlides: 1
        });
        $('.ch-galleries .slide').click(function (e) {
            e.preventDefault();
            var link = $(this).attr('href');
            $('.col-imgae .main-image img').attr('src', link).fadeIn(200);
        });
        $('.row-skins .skins .list-skins').bxSlider({
            slideWidth: 300,
            minSlides: 2,
            maxSlides: 3,
            slideMargin: 10,
            moveSlides: 1,
            captions: true
        });

        $('#main-active-media').bxSlider({
            pagerCustom: '.list-medias',
            slideWidth: 700
        });

        $('.list-medias').bxSlider({
            slideWidth: 150,
            minSlides: 1,
            maxSlides: 5,
            slideMargin: 7,
            moveSlides: 1
        });
//        $('.tax-fl_media_cat .list-medias .media a').click(function(e){
//            e.preventDefault();
//            var img = $(this).find('img').attr('src');
//            $('#show-media img').attr('src', img);
//        });

        //votes
        $('#iz-votes .btn-vote-up').click(function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: params.ajaxurl,
                data: {
                    action: 'iz_like_post',
                    post_id: $(this).attr('data-id'),
                    ip_addr: $(this).attr('data-ip')
                },
                success: function (data) {
                    $('#iz-votes .number').html(data.num + ' Votes');
                }
            });
        });
        $('#iz-votes .btn-vote-down').click(function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: params.ajaxurl,
                dataType: 'json',
                data: {
                    action: 'iz_dislike_post',
                    post_id: $(this).attr('data-id'),
                    ip_addr: $(this).attr('data-ip')
                },
                success: function (data) {
                    $('#iz-votes .number').html(data.num + ' Votes');
                }
            });
        });

        $('.guide-thumbnail #guide-upload').click(function (e) {
            e.preventDefault();
            var custom_uploader = wp.media({
                title: 'Chọn ảnh',
                button: {
                    text: 'Chọn ảnh'
                },
                multiple: false  // Set this to true to allow multiple files to be selected
            })
                    .on('select', function () {
                        var attachment = custom_uploader.state().get('selection').first().toJSON();
                        $('.guide-thumbnail .show-thumbnail').attr('src', attachment.url);
                        $('.guide-thumbnail .guide-thumbnail-value').val(attachment.url);
                    })
                    .open();
        });



        //play video
        $('.skills .skill .icon .play').click(function (e) {
            e.preventDefault();
            var video = $('.video-modal #iz-video')[0];
            video.src = $(this).attr('data-url');
//            video.play();
        });
        $('.list-skins .skin .icon .play').click(function (e) {
            e.preventDefault();
            var video = $('#iz-frame');
            video.html($(this).attr('data-url'));
        });


        

    });
})(jQuery);

