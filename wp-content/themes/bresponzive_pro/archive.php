<?php get_header(); ?>		
<?php global $data; ?>
<div id="blocks-wrapper" class="row clearfix">
    <div class="col-sm-12 col-sm-8">
        <div id="blocks-left" class="eleven columns clearfix">	
            <!--Archive content-->
            <!-- .blogposts-wrapper-->

            <h2 class="blogpost-wrapper-title" style="margin-top:30px;">
                <?php if (is_day()): ?>
                    <?php printf(__('Ngày: %s', 'iz_theme'), get_the_date()); ?>
                <?php elseif (is_month()) : ?>
                    <?php printf(__('Tháng: %s', 'iz_theme'), get_the_date('F Y')); ?>
                <?php elseif (is_year()) : ?>
                    <?php printf(__('Năm: %s', 'iz_theme'), get_the_date('Y')); ?>
                <?php elseif (is_category() || is_tag()): ?>
                    <?php single_cat_title(); ?>
                <?php elseif (is_author()): ?>	
                    <?php printf(__('Author: %s', 'iz_theme'), $curauth->nickname); ?>
                <?php else: ?>
                    <?php _e('Blog', 'iz_theme'); ?>
                <?php endif; ?>
            </h2> 
            <?php 
            
            include_once('includes/blog_loop.php'); 
            ?>
            
            <div class="create-post">
                <a class="btn btn-primary" href="#"><?php echo __('Đăng bài', 'iz_theme'); ?></a>
            </div>
        </div>
    </div>
    <!-- END MAIN -->
    <?php get_sidebar(); ?>
    <?php get_footer(); ?>