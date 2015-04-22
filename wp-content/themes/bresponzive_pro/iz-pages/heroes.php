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
                'post_type' => 'fl_champion', 'orderby'=>'title', 'order'=>'ASC', 'showposts'=>-1
            ));
            ?>
            <div class="list-champions">
                <div class="ch-row">
                <?php $i=0; if (have_posts()): while (have_posts()): the_post(); ?>
                
                         <?php $status = get_post_meta(get_the_ID(), 'iz-ch-status', true); ?>
                                <div class="wrap <?php echo $status ?>">
                                <a href="<?php the_permalink(); ?>" data-id="<?php echo get_the_ID() ?>" title="<?php the_title() ?>">
                                    <img src="<?php echo get_post_meta(get_the_ID(), 'iz-ch-face', true); ?>" />
                                </a>
                            </div>
                            <div class="row text-tooltip">
                                <div class="col-sm-4 image">
                                    <div><?php the_post_thumbnail('pager'); ?></div>
                                </div>
                                <div class="col-sm-8 excerpt">
                                    <h4><?php the_title(); ?></h4>
                                    <p><?php the_short_desc(30); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php $i++; if($i==3){echo '</div><div class="ch-row">';}
                    endwhile;
                    echo '</div>';
                    wp_reset_query();
                else:
                    ?>

                <?php endif; ?>

            </div>
            
            <h1 class="entry-title"><?php echo __('Hưỡng dẫn phổ biến', 'iz_theme') ?></h1>
            <?php query_posts(array('post_type'=>'fl_guide', 'posts_per_page'=>10, 'meta_key' => 'iz-vote-post', 'orderby'=>'meta_value_num' )); ?>
            <div class="list-guide list-posts">
                                <?php if (have_posts()):while (have_posts()):the_post(); ?>
                                        <div <?php post_class('row iz-guide post') ?> >
                                            <a href="<?php the_permalink() ?>">
                                                <div class="col-sm-2 col-md-1 image">
                                                    <?php the_post_thumbnail('sb-post-thumbnail', array()) ?>
                                                </div>
                                                <div class="col-sm-8 col-md-9 post-info">
                                                    <h4 class="title"><?php the_title(); ?></h4>
                                                    <div class="meta">
                                                        <strong class="author"><?php the_author() ?></strong> || <?= __('Đăng vào: ', 'iz_theme') ?><span class="time"><?php the_time('F j, Y'); ?> - <?php the_time('g:i a') ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 votes" style="text-align: right;">
                                                    <span class="number btn btn-primary"><?php $vote = get_post_meta(get_the_ID(), 'iz-vote-post', true);
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


