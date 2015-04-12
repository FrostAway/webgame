<?php
/*
 * Template Name: Heroes Page
 */
?>

<?php get_header(); ?>
<!--#blocks-wrapper-->
<div id="blocks-wrapper" class="clearfix">

    <div id="heroes">

        <div class="post-content">
            <h1 class="entry-title"><?php the_title(); ?></h1>

            <?php
            query_posts(array(
                'post_type' => 'fl_champion',
                'hide_empty' => false
            ));
            ?>
            <div class="list-champions">
                <?php if (have_posts()): while (have_posts()): the_post(); ?>
                        <div class="iz-champion">
                            <div class="wrap">
                                <a href="<?php the_permalink(); ?>" data-id="<?php echo get_the_ID() ?>" title="<?php the_title() ?>">
                                    <?php the_post_thumbnail('pager') ?>
                                </a>
                            </div>
                            <div class="text-tooltip">
                                <div class="title">
                                    <span><?php the_post_thumbnail('pager'); ?></span>
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
            
            <hr />
            
            
            <h1 class="entry-title"><?php echo __('Hưỡng dẫn phổ biến', 'iz_theme') ?></h1>
            <?php query_posts(array('post_type'=>'fl_guide', 'posts_per_page'=>5)); ?>
            <div class="list-guide list-posts">
                                <?php if (have_posts()):while (have_posts()):the_post(); ?>
                                        <div <?php post_class('row iz-guide post') ?> >
                                            <a href="<?php the_permalink() ?>">
                                                <div class="col-sm-2 col-md-1 image">
                                                    <?php the_post_thumbnail('ch-guide', array()) ?>
                                                </div>
                                                <div class="col-sm-8 col-md-9 post-info">
                                                    <h4 class="title"><?php the_title(); ?></h4>
                                                    <div class="meta">
                                                        <strong class="author"><?php the_author() ?></strong> || <?= __('Đăng vào: ', 'iz_theme') ?><span class="time"><?php the_time('F j, Y'); ?> - <?php the_time('g:i a') ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 votes">
                                                    <span class="number btn btn-success"><?php $vote = get_post_meta(get_the_ID(), 'iz-vote-post', true);
                                                if($vote == '') echo 0; else echo $vote; ?> Votes</span>
                                                </div>
                                            </a>
                                        </div>
                                    <?php
                                    endwhile;
                                    wp_reset_query();
                                else:
                                    ?>

                        <?php endif; ?>
                            </div>
        
        <div class="pagination clearfix">
            <?php bresponZive_themepacific_tpcrn_pagination(); ?>
        </div>

    </div>

</div>


</div>

<?php get_footer(); ?>


