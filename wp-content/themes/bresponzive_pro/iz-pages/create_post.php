<?php
/*
 * Template Name: Create Post
 */

get_header();
?>

<div id="blocks-wrapper" class="clearfix">
    <div id="create-post">
        <div class="post-content">
            
            <?php if(isset($_GET['pid'])){ ?>
            <h1 class="entry-title"><?php  echo __('Chỉnh sửa bài viết', 'iz_theme'); ?></h1>
            <?php 
            echo do_shortcode('[wpuf_edit]');
            }else{ ?>
            <h1 class="entry-title"><?php echo __('Đăng bài viết', 'iz_theme'); ?></h1>
            
            <?php echo do_shortcode('[wpuf_form id="1293"]'); ?>
            <?php } ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>