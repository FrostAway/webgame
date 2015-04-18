<?php

/* 
 * Template Name: Register
 */
?>
<?php get_header(); ?>

<div id="blocks-wrapper" class="clearfix">

    <div id="game-guide">        
        <?php ?>       
        <div class="post-content">
            <h1 class="entry-title"><?php the_title(); ?></h1>
            
            <div class="entry-content">
                <?php echo do_shortcode('[wpuf_profile type="registration" id="1264"]'); ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
