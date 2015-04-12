(function($){
    $(document).ready(function(){
        var custom_uploader;
       $('.add_champion_images').click(function(e){
           e.preventDefault();
           if(custom_uploader){
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
           custom_uploader.on('select', function(){
              attachment = custom_uploader.state().get('selection').first().toJSON();
              $('#champion-gallery .champion-images').append(
                      '<li>'+
                      '<img width="150" height="150" src="'+attachment.url+'" />'+
                      '<div class="actions"><a class="delete tips" href="#">Xóa</a></div>'+
                      '<input type="hidden" name="fl-champion-gallerys[]" value="'+attachment.url+'" />'+
                      '</li>'
                      );
           });
           custom_uploader.open();
       }) ;
    });
})(jQuery);

