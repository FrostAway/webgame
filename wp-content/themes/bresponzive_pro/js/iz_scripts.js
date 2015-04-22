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
                        $(this).find('.value').text((value + addlevel * parseInt(ui.value)).toFixed(2));
                        $(this).find('.iz-curr-value').val((value + addlevel * parseInt(ui.value)).toFixed(2));
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

                var tier = $(this).attr('data-tier');
                var pos = $(this).attr('data-pos');
                var name = $(this).attr('data-name');
                var skills = JSON.parse($(this).attr('data-skill'));
                var talent = $(this).attr('data-talent');
                var data_index_term = JSON.parse($(this).attr('data-index-term'));
                var data_ug_id = JSON.parse($(this).attr('data-ug-index'));
                var data_bases = JSON.parse($(this).attr('data-base'));
                var coldowns = JSON.parse($(this).attr('data-coldown'));
                var skill_news = JSON.parse($(this).attr('data-new'));


                thisa.find('.none').each(function () {
                    var none_talent = $(this).attr('data-talent');
                    var none_iskills = JSON.parse($(this).attr('data-skill'));
                    var none_newskills = JSON.parse($(this).attr('data-new'));

                    for (var i = 0; i < none_iskills.length; i++) {
                        $('#skill-' + none_iskills[i] + ' .info #tl-add-' + none_talent).remove();
                        $('#skill-' + none_iskills[i] + ' .info .description #tl-desc-' + none_talent).remove();
                        if (none_newskills[none_iskills[i]] !== "0") {
                            $('#skill-' + none_newskills[none_iskills[i]]).addClass('skill-hide');
                        }
                        var basedf = $('#skill-' + none_iskills[i] + ' .base .base-default').val();
                        if (basedf !== '') {
                            $('#skill-' + none_iskills[i] + ' .base .base-num').html(basedf);
                        }
                        var chager_col_df = $('#skill-' + none_iskills[i] + ' .coldown .chager-col-default').val();
                        if (chager_col_df !== '') {
                            $('#skill-' + none_iskills[i] + ' .coldown .chager-col').html(chager_col_df);
                        }
                    }
                });


                var desc = '<div class="desc" id="tl-desc-' + talent + '">[<span>' + name + '</span>] ' + $(this).attr('data-title') + '</div>';
                var add_text = '<span id="tl-add-' + talent + '">[' + name + ']</span> ';
                if (skills !== null) {
                    for (var i = 0; i < skills.length; i++) {
                        if ($('#skill-' + skills[i] + ' .info .at-lv-' + tier + ' #tl-add-' + talent).length <= 0) {
                            $('#skill-' + skills[i] + ' .info .desclv-' + tier).append(desc);
                            $('#skill-' + skills[i] + ' .info .at-lv-' + tier).append(add_text);
                        }

                        if (data_bases !== null) {
                            var base = parseInt(data_bases[skills[i]]) + parseInt($('#skill-' + skills[i] + ' .base .base-default').val());
                            $('#skill-' + skills[i] + ' .base .base-num').html(base);
                        }

                        var changer_col = coldowns[skills[i]];
                        $('#skill-' + skills[i] + ' .coldown .chager-col').html(changer_col);

                        if (skill_news[skills[i]] !== "0") {
                            $('#skill-' + skill_news[skills[i]]).removeClass('skill-hide').appendTo('.list-skill');
                        }


                    }
                }

                thisa.find('.ind').html('(' + pos + ')');

                $('.col-ind').each(function () {
                    var value = $(this).find('.value');
                    var curr_value = $(this).find('.iz-curr-value').val();
                    value.html(curr_value);
                });

                if (data_index_term !== null) {
                    for (var i = 0; i < data_index_term.length; i++) {
                        var current = $('#iz-index-' + data_index_term[i]).find('.value').html();
                        var newval;
                        if (current === '' || current === 'NA' || current === 'NaN') {
                            newval = 'NA';
                        } else {
                            newval = parseInt(current) + parseInt(data_ug_id[data_index_term[i]]);
                        }
                        $('#iz-index-' + data_index_term[i]).find('.value').html(newval);
                    }
                }

                //url
                var stt = '';
                $('.talent-image .talents .level').each(function () {
                    var ele = $(this).find('a');
                    var check = 0;
                    ele.each(function () {
                        if ($(this).hasClass('active')) {
                            check = $(this).attr('data-pos');
                        }
                    });
                    stt = stt + check.toString();
                });
                var path = $('#talent-path').val();
                $('#share-talent-url').val(params.talent_page + '?stt=' + stt);
                $('#bbcode').val('[embed=' + path + '?stt=' + stt + ']');

                history.pushState('data', '', params.talent_page + '?stt=' + stt);
                $('.share-btn a').attr('data-href', 'https://www.facebook.com/sharer/sharer.php?u=' + params.talent_page + '?stt=' + stt);
                $('.share-btn a').attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' + params.talent_page + '?stt=' + stt);
            });

            $('.list-skill .iz-skill .info .open-close').click(function () {
                var desc = $(this).closest('.info').find('.description');
                if (desc.css('display') === 'none') {
                    $('.list-skill .iz-skill .info .description').slideUp();
                    $('.list-skill .iz-skill .info .open-close').html('[+]');
                    $(this).closest('.info').find('.add-text').fadeOut(100);
                    desc.slideDown();
                    $(this).html('[-]');
                } else {
                    desc.slideUp();
                    $(this).closest('.info').find('.add-text').fadeIn()(100);
                    $(this).html(['[+]']);
                }
            });

            //talent
            $('#reset-talent').click(function (e) {
                e.preventDefault();
                $('.list-skill .iz-skill .info .description').slideUp();
                $('.list-skill .iz-skill .info .open-close').html('[+]');

                $('.talent-image .talents .level a').removeClass('active');
                $('.talent-image .talents .level a').removeClass('none');
                $('.talent-image .talents .level .ind').html('(0)');

                $('.list-skill .iz-skill .info .description .desc').remove();
                $('.list-skill .iz-skill .info .add-text span').remove();

                $('#share-talent-url').val('');
                $('#bbcode').val('');

                history.pushState('data', '', params.talent_page);
                $('.share-btn a').attr('data-href', 'https://www.facebook.com/sharer/sharer.php?u=' + params.talent_page);
                $('.share-btn a').attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' + params.talent_page);
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
                    $('#iz-votes .stt-text').html(data.mess);
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

//        $('.guide-thumbnail #guide-upload').click(function (e) {
//            e.preventDefault();
//            var custom_uploader = wp.media({
//                title: 'Chọn ảnh',
//                button: {
//                    text: 'Chọn ảnh'
//                },
//                multiple: false  // Set this to true to allow multiple files to be selected
//             
//            })
//                    .on('select', function () {
//                        var attachment = custom_uploader.state().get('selection').first().toJSON();
//                        $('.guide-thumbnail .show-thumbnail').attr('src', attachment.url);
//                        $('.guide-thumbnail .guide-thumbnail-value').val(attachment.url);
//                        $('.guide-thumbnail .attach-id').val(attachment.id);
//                        $('.guide-thumbnail .thumbnail-type').val(attachment.type);
//                        $('.guide-thumbnail .thumbnail-name').val(attachment.title);
//                    })
//                    .open();
//        });

        $('.guide-thumbnail #guide-upload').click(function (event) {
            var frame;
            event.preventDefault();
            if (frame) {
                frame.open();
                return;
            }
            frame = wp.media({
                title: 'Chọn ảnh',
                button: {
                    text: 'Chọn ảnh'
                },
                multiple: false,
                states: [
                    new wp.media.controller.Library({
                        filterable: 'all' // turn on filters
                    })
                ]
            });
            frame.on("select", function () {
                var attachment = frame.state().get('selection').first().toJSON();
                frame.close();
                $('.guide-thumbnail .show-thumbnail').attr('src', attachment.url);
                $('.guide-thumbnail .guide-thumbnail-value').val(attachment.url);
                $('.guide-thumbnail .attach-id').val(attachment.id);
                $('.guide-thumbnail .thumbnail-type').val(attachment.type);
                $('.guide-thumbnail .thumbnail-name').val(attachment.title);
            });
            frame.open();

        });



        //play video

        $('.list-skins .skin .icon .play, .skills .skill .icon .play').click(function (e) {
            e.preventDefault();
            var video = $('#iz-frame');
            video.html($(this).attr('data-url'));
        });




    });
})(jQuery);

