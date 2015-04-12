<?php get_header(); ?>		
<?php global $data; ?>
<div id="blocks-wrapper" class="clearfix">

    <div class="col-sm-12 col-md-8 left-col">
        <div id="blocks-left" class="eleven columns clearfix">	
            <!--Archive content-->
            <!-- .blogposts-wrapper-->

            <?php
            if ($data['posts_bread'] == 'On') {
                bresponZive_themepacific_breadcrumb();
            }
            ?>

            <h2 class="blogpost-wrapper-title" style="margin-top:30px;">
                <?php if (is_tax('fl_guide_cat')): ?>
                    <?php printf(__('%s', 'iz_theme'), single_term_title('', false)) ?>
                <?php elseif (is_day()): ?>
                    <?php printf(__('Danh mục ngày: %s', 'iz_theme'), get_the_date()); ?>
                <?php elseif (is_month()) : ?>
                    <?php printf(__('Danh mục tháng: %s', 'iz_theme'), get_the_date('F Y')); ?>
                <?php elseif (is_year()) : ?>
                    <?php printf(__('Danh mục Năm: %s', 'iz_theme'), get_the_date('Y')); ?>
                <?php elseif (is_category() || is_tag()): ?>
                    <?php printf(__('%s', 'iz_theme'), single_cat_title('', false)); ?>
                <?php elseif (is_author()): ?>	
                    <?php printf(__('Thành viên: %s', 'iz_theme'), $curauth->nickname); ?>
                <?php else: ?>
                    <?php _e('Blog', 'iz_theme'); ?>
                <?php endif; ?>
            </h2> 
            <?php //include_once('includes/blog_loop.php'); ?>

            <?php if (have_posts()): ?>
                <div id="iz-list-guide" class="list-posts">
                    <?php while (have_posts()): the_post(); ?>

                        <div <?php post_class('iz-guide row post') ?> >
                            <a href="<?php the_permalink() ?>">
                                <div class="col-sm-2 image">
                                    <?php the_post_thumbnail('ch-guide') ?>
                                </div>
                                <div class="col-sm-8 post-info">
                                    <h3 class="title"><?php the_title(); ?></h3>
                                    <div class="meta">
                                        <strong class="author"><?php the_author() ?></strong> || <?= __('Đăng vào: ', 'iz_theme') ?><span class="time"><?php the_time('F j, Y'); ?> - <?php the_time('g:i a') ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-2 votes">
                                    <span class="number btn btn-success"><?php
                                        $vote = get_post_meta(get_the_ID(), 'iz-vote-post', true);
                                        if ($vote == '')
                                            echo 0;
                                        else
                                            echo $vote;
                                        ?> Votes</span>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>

                </div>
            <?php else: ?>

            <?php endif; ?>
            
            <div class="pagination clearfix">
<?php bresponZive_themepacific_tpcrn_pagination(); ?>
</div>
        </div>
    </div>
    <!-- END MAIN -->
    <?php get_sidebar(); ?>
    <?php get_footer(); ?>