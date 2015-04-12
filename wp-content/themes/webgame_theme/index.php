<?php get_header(); // This fxn gets the header.php file and renders it  ?>
<div id="primary" class="row-fluid">
    <div id="content" role="main" class="span8 offset2">
        
        <?php query_posts(array(
            'post_type' => 'product',
            'showposts' => 10,
        )); ?>
        
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article class="post">
                    
                    <?php wc_get_template_part('content', 'product'); ?>

                    <div class="meta clearfix">
                        <div class="category"><?php echo get_the_category_list(); // Display the categories this post belongs to, as links  ?></div>
                        <div class="tags"><?php echo get_the_tag_list('| &nbsp;', '&nbsp;'); // Display the tags this post has, as links separated by spaces and pipes  ?></div>
                    </div><!-- Meta -->
                </article>
            <?php endwhile;     wp_reset_query(); ?>

            <!-- pagintation -->
            <div id="pagination" class="clearfix">
                <div class="past-page"><?php previous_posts_link('newer'); // Display a link to  newer posts, if there are any, with the text 'newer'  ?></div>
                <div class="next-page"><?php next_posts_link('older'); // Display a link to  older posts, if there are any, with the text 'older'  ?></div>
            </div><!-- pagination -->

        <?php else : ?>

            <article class="post error">
                <h1 class="404">Nothing has been posted like that yet</h1>
            </article>

        <?php endif; ?>
    </div><!-- #content .site-content -->
</div><!-- #primary .content-area -->
<?php get_footer(); ?>