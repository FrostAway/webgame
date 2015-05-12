<?php
/*
 * Template Name: Game Guide
 */
?>

<?php get_header(); ?>
<!--#blocks-wrapper-->
<div id="blocks-wrapper" class="clearfix">

    <div id="game-guide">

        <?php ?>

        <div class="post-content" style="position: relative;">
         
            <div class="guide-header">
            <h1 class="entry-title"><?php the_title(); ?></h1>
            
            <p class="desc" style="max-width: 350px;">This section is designed as your guide through the epic fantasy of World of Warcraft, from your earliest quests to the glory that awaits you as a true champion of Azeroth.</p>
            
            <a class="btn btn-success" href="<?php echo get_page_link(1082) ?>"><?php echo __('Tạo Guide', 'iz_theme') ?></a>
            </div>
            <div class="list-guide-box">
                <?php
                $guide_cats = get_terms('fl_guide_cat', array('hide_empty' => false, 'parent' => 0));
                if ($guide_cats) {
                    foreach ($guide_cats as $cat) {
                        ?>
                        <div class="guide-cat">
                            <h3 class="title"><img class="icon" src="<?php echo z_taxonomy_image_url($cat->term_id) ?>" /> <a href="<?php echo get_term_link($cat) ?>"><?php echo $cat->name ?></a></h3>
                            <?php
                            query_posts(array('post_type' => 'fl_guide', 'showposts' => 3, 'meta_key'=>'iz-vote-post', 'orderby'=>'meta_value_num', 'tax_query' => array(
                                    array(
                                        'taxonomy' => 'fl_guide_cat',
                                        'field' => 'term_id',
                                        'terms' => $cat->term_id
                                    )
                            )));
                            ?>
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
                                                <div class="col-sm-2 col-md-2 votes" style="text-align: right;">
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
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>


    </div>

<?php get_footer(); ?>

