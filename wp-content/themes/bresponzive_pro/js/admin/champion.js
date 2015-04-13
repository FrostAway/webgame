(function ($) {
    $(document).ready(function () {

        //indexs


//        function add_index() {
//            $('#champion-ind .add_index').click(function (e) {
//                e.preventDefault();
//                var num = $('#champion-ind .champion-ind-table .index').size();
//                var numlv = $('#champion-ind #select-level').val();
//                $('#champion-ind .champion-ind-table').append(
//                        '<tr class="index">' +
//                        '<th class="icon">' +
//                        '<input type="text" name="iz-ch-indexs[' + numlv + '][' + num + '][]" value=""' +
//                        '</th>' +
//                        '<td class="value">' +
//                        '<input name="iz-ch-indexs[' + numlv + '][' + num + '][]" type="text" value="" size="60" />' +
//                        '</td>' +
//                        '<td><a class="button index-del" href="#"><span class="dashicons dashicons-no-alt" style="padding-top: 3px;"></span></a></td>' +
//                        '</tr>'
//                        );
//
//                $('#champion-ind .index-del').click(function (e) {
//                    e.preventDefault();
//                    $(this).closest('tr').removeClass('index').fadeOut(200).html('');
//                });
//            });
//        }
//        add_index();
//        
//        $('#champion-ind .index-del').click(function (e) {
//            e.preventDefault();
//            $(this).closest('tr').removeClass('index').fadeOut(200).html('');
//        });
//
//
//        $('#champion-ind .index-del').click(function (e) {
//            e.preventDefault();
//            $(this).closest('tr').removeClass('index').fadeOut(200).html('');
//        });




        //end index


        //gallery
        var custom_uploader;
        $('.add_champion_images').click(function (e) {
            e.preventDefault();
            if (custom_uploader) {
                custom_uploader.open();
                return;
            }
            custom_uploader = wp.media.frames.file_frame = wp.media({
                title: 'Chọn ảnh',
                button: {
                    text: 'Chọn ảnh'
                },
                multiple: false
            });
            custom_uploader.on('select', function () {
                attachment = custom_uploader.state().get('selection').first().toJSON();
                $('#champion-gallery .champion-images').append(
                        '<li class="image">' +
                        '<img width="150" class="iz-ch-image" height="150" src="' + attachment.url + '" />' +
                        '<input type="hidden" class="iz-ch-imgurl" name="iz-ch-galleries[]" value="' + attachment.url + '" />' +
                        '<a class="iz-actions-del dashicons dashicons-no-alt" href="#"></a>' +
                        '</li>'
                        );
                $('.iz-actions-del').click(function (e) {
                    e.preventDefault();
                    $(this).parent('.image').fadeOut(200).html('');
                });
            });
            custom_uploader.open();
        });
        $('.iz-actions-del').click(function (e) {
            e.preventDefault();
            $(this).parent('.image').fadeOut(200).html('');
        });

        //end gallery


        //skill
        //add icon skill
        function skill_icon() {
            var custom_uploader_icon;
            $('#champion-skill .icon .icon-image, #champion-skill .animate .icon-image').click(function (e) {
                var curr_icon = $(this).find('img');
                var skill_url = $(this).parent().find('.iz-ch-skill-url');
                e.preventDefault();
                if (custom_uploader_icon) {
                    custom_uploader_icon.open();
                    return;
                }
                custom_uploader_icon = wp.media.frames.file_frame = wp.media({
                    title: 'Chọn ảnh',
                    button: {
                        text: 'Chọn ảnh'
                    },
                    multiple: false
                });
                custom_uploader_icon.on('select', function () {
                    attachment = custom_uploader_icon.state().get('selection').first().toJSON();
                    curr_icon.attr('src', attachment.url);
                    skill_url.val(attachment.url);
                    custom_uploader_icon = false;
                    $('.skill-url-del').click(function (e) {
                        e.preventDefault();
                        $(this).parent().find('.icon-image img').attr('src', '');
                        $(this).parent().find('.iz-ch-skill-url').val('');
                    });
                });
                custom_uploader_icon.open();
            });

            $('.skill-url-del').click(function (e) {
                e.preventDefault();
                $(this).parent('').find('.icon-image img').attr('src', '');
                $(this).parent('').find('.iz-ch-skill-url').val('');
            });
        }
        skill_icon();
        //end add icon skill

        //add row skill
        $('#champion-skill #add-skill').click(function (e) {
            e.preventDefault();
            var num = $('#champion-skill table tbody .iskill').size();
            $("#champion-skill table tbody").append(
                    '<tr class="iskill">' +
                    '<td class="icon">' +
                    '<a class="icon-image" href="#"><img height="45" width="45" src="" /></a>' +
                    '<input type="hidden" class="iz-ch-skill-url" name="iz-ch-skills[' + num + '][]" value="" />' +
                    '<a class="skill-url-del dashicons dashicons-no-alt"></a>' +
                    '</td>' +
                    '<td class="name"><input type="text" size="15" name="iz-ch-skills[' + num + '][]" value="" /></td>' +
                    '<td class="mana"><input type="number" name="iz-ch-skills[' + num + '][]" value="" /></td>' +
                    '<td class="down"><input type="number" name="iz-ch-skills[' + num + '][]" value="" /></td>' +
                    '<td class="desc"><textarea name="iz-ch-skills[' + num + '][]"></textarea></td>' +
                    '<td class="animate">'+
                            '<a class="icon-image" href="#"><img height="70" width="70" src="" alt="Select" /></a>'+
                            '<input type="hidden" class="iz-ch-skill-url" name="iz-ch-skills['+num+'][]" value="" />'+
                            '<a class="skill-url-del dashicons dashicons-no-alt"></a>'+ 
                        '</td>'+
                    '<td class="skill-del"><a href="#" class="button"><span class="dashicons dashicons-no-alt" style="padding-top: 3px;"></span></a></td>' +
                    '</tr>'
                    );
            $('#champion-skill .skill-del a').click(function (e) {
                e.preventDefault();
                $(this).closest('tr').removeClass('iskill').fadeOut(200).remove();
            });

            skill_icon();

        });

        $('#champion-skill .skill-del a').click(function (e) {
            e.preventDefault();
            $(this).closest('tr').removeClass('iskill').fadeOut(200).remove();
        });
        //end add row skill

        //skin
        // add icon image
        function skin_icon() {
            var skin_upload;
            $('#champion-skins .icon .icon-image').click(function (e) {
                var curr_icon = $(this).find('img');
                var skill_url = $(this).parent('.icon').find('.iz-ch-skin-url');
                e.preventDefault();
                if (skin_upload) {
                    skin_upload.open();
                    return;
                }
                skin_upload = wp.media.frames.file_frame = wp.media({
                    title: 'Chọn ảnh',
                    button: {
                        text: 'Chọn ảnh'
                    },
                    multiple: false
                });
                skin_upload.on('select', function () {
                    attachment = skin_upload.state().get('selection').first().toJSON();
                    curr_icon.attr('src', attachment.url);
                    skill_url.val(attachment.url);
                    skin_upload = false;
                    $('.skin-url-del').click(function (e) {
                        e.preventDefault();
                        $(this).parent('.icon').find('.icon-image img').attr('src', '');
                        $(this).parent('.icon').find('.iz-ch-skin-url').val('');
                    });
                });
                skin_upload.open();
            });

            $('.skin-url-del').click(function (e) {
                e.preventDefault();
                $(this).parent('.icon').find('.icon-image img').attr('src', '');
                $(this).parent('.icon').find('.iz-ch-skin-url').val('');
            });
        }
        skin_icon();
        //end add icon image

        //add row skin       
        $('#champion-skins #add-skin').click(function (e) {
            e.preventDefault();
            var num = $('#champion-skins table tbody .iskin').size();
            $("#champion-skins table tbody").append(
                    '<tr class="iskin">' +
                    '<th><span class="dashicons dashicons-arrow-right-alt2"></span></th>' +
                    '<td class="icon">' +
                    '<a class="icon-image" href="#"><img height="80" width="80" src="" /></a>' +
                    '<input type="hidden" class="iz-ch-skin-url" name="iz-ch-skins[' + num + '][]" value="" />' +
                    '<a class="skin-url-del dashicons dashicons-no-alt"></a>' +
                    '</td>' +
                    '<td class="desc"><textarea name="iz-ch-skins[' + num + '][]"></textarea></td>' +
                    '<td class="link"><textarea name="iz-ch-skins[' + num + '][]"></textarea></td>' +
                    '<td class="skin-del"><a href="#" class="button"><span class="dashicons dashicons-no-alt" style="padding-top: 3px;"></span></a></td>' +
                    '</tr>'
                    );
            $('#champion-skins .skin-del a').click(function (e) {
                e.preventDefault();
                $(this).closest('tr').removeClass('iskin').fadeOut(200).remove();
            });

            skin_icon();

        });

        $('#champion-skins .skin-del a').click(function (e) {
            e.preventDefault();
            $(this).closest('tr').removeClass('iskin').fadeOut(200).remove();
        });
        //end add row skin

        //end skill

        //champion face
        $('#champion-face #btn-champion-face').click(function (e) {
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
                        $('#champion-face #show-chapion-face').attr('src', attachment.url);
                        $('#champion-face #champion-face-value').val(attachment.url);
                    })
                    .open();
        });
        $('#champion-face #del-champion-face').click(function (e) {
            e.preventDefault();
            $(this).closest('#champion-face').remove();
        });
        
        //champion_bg
        $('#champion-bg #btn-champion-bg').click(function (e) {
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
                        $('#champion-bg #show-bg-image').attr('src', attachment.url);
                        $('#champion-bg #champion-bg-value').val(attachment.url);
                    })
                    .open();
        });
        $('#champion-bg #del-bg-image').click(function (e) {
            e.preventDefault();
            $(this).closest('#champion-bg').remove();
        });

    });

})(jQuery);

