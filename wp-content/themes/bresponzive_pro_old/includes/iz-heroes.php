


<div class="fluid_container clearfix">

    <?php
    query_posts(array(
                'post_type' => 'fl_champion', 'orderby'=>'title', 'order'=>'ASC', 'showposts'=>-1
            ));
    ?>
    <div id="heroes">
        <div class="camera_wrap camera_orange_skin  " id="camera_wrap_2" style="display: block;">
            <div class="list-champions" style="padding-left: 19px; padding-right: 19px;">

                <div class="ch-row">
                    <?php
                    $i = 0;
                    if (have_posts()): while (have_posts()): the_post();
                            ?>

                            <div class="iz-champion">
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
                            <?php
                            $i++;
                            if ($i == 8) {
                                echo '</div><div class="ch-row">';
                            } 
							if($i==15){
								echo '</div><div class="ch-row">';
							}
							if($i==23){
								echo '</div><div class="ch-row">';
							}
							if($i==30){
								echo '</div><div class="ch-row">';
							}
                        endwhile;

                        wp_reset_query();
                    else:
                        ?>

                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.fluid_container -->


<div style="clear:both; display:block;"></div>