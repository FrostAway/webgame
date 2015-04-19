<div class="blog-lists-blog clearfix">
    <div id="themepacific_infinite" class="blogposts-wrapper clearfix"> 
        <?php
        
        if (have_posts()) : while (have_posts()) : the_post();
                get_template_part('content', get_post_format());
            endwhile; 
            ?>
        </div>				 
        <?php else: ?>
        <h4 class="noposts"><?php _e('Không tìm thấy bài viết nào!', 'iz_theme'); ?></h4>
    </div>
<?php endif; ?>
<?php wp_reset_query(); ?>
</div>
<div class="pagination clearfix">
<?php bresponZive_themepacific_tpcrn_pagination(); ?>
</div>

