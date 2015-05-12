<?php

/* 
 * Template Name: Quản lý
 */
get_header();
?>

<div id="blocks-wrapper" class="clearfix">
    <div id="post_manage">
        <div class="post-content">
            <h1 class="entry-title"><?php echo __('Thông tin cá nhân', 'iz_theme'); ?></h1>
           
            <?php echo do_shortcode('[wpuf_profile type="profile" id="1264"]'); ?>
            
            <h1 class="entry-title"><?php echo __('Quản lý bài đăng', 'iz_theme'); ?></h1>
            <?php echo do_shortcode('[wpuf_dashboard]'); ?>
            <?php echo do_shortcode('[wpuf_dashboard post_type="fl_guide"]'); ?>
           
        </div>
        <script>
            (function($){
                $(document).ready(function(){
                   $('.wpuf-author:first').remove(); 
                });
            })(jQuery);
        </script>
    </div>
</div>

<?php get_footer(); ?>

