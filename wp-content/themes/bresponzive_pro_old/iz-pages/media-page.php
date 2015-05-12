<?php
/*
 * Template Name: Media Page
 */
?>

<?php get_header(); ?>
<!--#blocks-wrapper-->
<div id="blocks-wrapper" class="clearfix">
    <div id="media">
        <div class="post-content">
            <?php
                    if ($data['posts_bread'] == 'On') {
                        bresponZive_themepacific_breadcrumb();
                    }
                    ?>
            <h1 class="entry-title"><?php the_title(); ?></h1>

            <div class="row">
            <?php
            $media_cats = get_terms('fl_media_cat', array('hide_empty' => false));
            
            foreach ($media_cats as $mcat) {
                ?>
                <div class="col-sm-6 media-cat">
                    <h3 class="entry-title"><img class="icon" src="<?php echo z_taxonomy_image_url($mcat->term_id); ?>" /> <?php echo $mcat->name ?><a class="view-all" href="<?php echo get_term_link($mcat); ?>"><?php echo __('Xem tất cả', 'iz_theme') ?> <span class="fa fa-angle-double-right"></span></a></h3>
                    <?php
                    query_posts(array(
                        'post_type' => 'attachment', 'post_status' => 'inherit', 'posts_per_page' => 4, 'tax_query' => array(
                            array(
                                'taxonomy' => 'fl_media_cat',
                                'field' => 'term_id',
                                'terms' => $mcat->term_id
                            )
                    )));
                    if (have_posts()):while (have_posts()): the_post();
                            ?>

                            <div class="col-sm-6 media">
                                <div class="pmedia">
                                <div class="image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php 
                                        if(wp_attachment_is_image()){
                                            echo wp_get_attachment_image(get_the_ID(), 'blog-image');
                                        }else{
                                            ?>
                                        <video controls="controls">
                                            <source src="<?php echo wp_get_attachment_url(); ?>" />
                                        </video>
                                            <?php
                                        }
                                        ?>
                                    </a>
                                </div>
                                <div class="title">
                                    <h4><?php the_title(); ?></h4>
                                </div>
                                </div>
                            </div>

                            <?php
                        endwhile;
                        wp_reset_query();
                    endif;
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>



