<?php get_header(); ?>		
<?php global $data; ?>
<div id="blocks-wrapper" class="clearfix row">
<!--#blocks-left-or-right-->
<div class="col-sm-12 col-md-8 left-col" style="padding-bottom: 20px;">
	<div id="blocks-left" class="eleven columns clearfix">	
        <!--Archive content-->
        <!-- .blogposts-wrapper-->

        <div id="heroes">
        
        <h2 class="blogpost-wrapper-title" style="margin-top:30px;">
            <?php if (is_tax('fl_champion_cat')): ?>
                <?php printf(__('%s', 'iz_theme'), single_term_title('', false)) ?>
            <?php endif; ?>
        </h2> 
        <?php //include_once('includes/blog_loop.php'); ?>

        <div class="list-champions">
                <?php if (have_posts()): while (have_posts()): the_post(); ?>
                        <div class="iz-champion">
                            <div class="wrap">
                                <a href="<?php the_permalink(); ?>" data-id="<?php echo get_the_ID() ?>" title="<?php the_title() ?>">
                                    <?php the_post_thumbnail('sb-post-thumbnail') ?>
                                </a>
                            </div>
                            <div class="text-tooltip">
                                <div class="title">
                                    <span><?php the_post_thumbnail('sb-post-thumbnail'); ?></span>
                                    <span><h3><?php the_title(); ?></h3></span>
                                </div>
                                <div class="excerpt">
                                    <?php the_short_desc(30); ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_query();
                else:
                    ?>

                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<!-- END MAIN -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>