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



            <?php if (have_posts()):while (have_posts()):the_post(); ?>

                    <?php
                    if ($data['posts_bread'] == 'On') {
                        bresponZive_themepacific_breadcrumb();
                    }
                    ?>

                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <div class="role"><?php echo get_the_term_list(get_the_ID(), 'fl_champion_cat', __('Vai trò tướng: ', 'iz_theme'), ', ', '.'); ?></div>
                    <div class="row content">
                        <div class="col-sm-12 col-md-6 col-text">

                            <div class="indexs">
                                <h3 class="title"><?php echo __('Chỉ số', 'iz_theme') ?></h3>
                                <?php
                                $indexs = get_post_meta(get_the_ID(), 'iz-ch-indexs', true);
                                $indexs = ($indexs == null) ? null : $indexs;
                                
                                $index_max = get_max_index();
                                
                                $term_indexs = get_terms('fl_champion_index', array('hide_empty' => false));
                                foreach ($term_indexs as $index) {
                                    ?>
                                    <div class="index">
                                        <div class="icon">
                                            <?php z_taxonomy_image($index->term_id) ?>
                                        </div>
                                        <div class="info">
                                            <div class="name">
                                                <?php echo $index->name; ?>
                                            </div>
                                            <div class="value">
                                                <?php echo $indexs[$index->term_id][0]; echo $index_max[$term->id] ?>
                                            </div>
                                            <div class="max">
                                                <div class="curr" style="width: <?php echo $indexs[$index->term_id][0] / $index_max[$index->term_id] * 100 ?>%"></div>
                                            </div>
                                        </div>

                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-imgae">
                            <div class="main-image">
                                <?php the_post_thumbnail(); ?>
                            </div>
                            <?php iz_galleries(get_the_ID()); ?>
                        </div>
                    </div>

                    <div class="row row-skins">
                        <div class="skins">
                            <h3><?php echo __('Ngoại trang', 'iz_theme') ?></h3>

                            <?php
                            $skins = get_post_meta(get_the_ID(), 'iz-ch-skins', true);
                            $skins = ($skins == null) ? null : $skins;
                            if ($skins != null) {
                                ?>
                                <div class="list-skins">
                                    <?php
                                    foreach ($skins as $skin) {
                                        ?>
                                        <div class="slide skin">
                                            <div class="icon">
                                                
                                                <a href="<?php echo $skin[0] ?>">
                                                    <?php 
                                                    $image = $skin[0]; 
                                                    $image = str_replace('.jpg', '-550x550.jpg', $skin[0]);
                                                    $image = str_replace('.png', '-550x550.png', $skin[0]);
                                                    ?>
                                                    <img src="<?php echo $image ?>" title="<?php echo $skin[1] ?>" />
                                                </a>
                                                
                                                <div class="play fa fa-play" data-url='<?php echo $skin[2] ?>' data-toggle="modal" data-target=".video-modal-frame"></div>
                                            </div>
                                            <!--                            <div class="name">
                                            <?php //echo $skin[1]  ?>
                                                                        </div>-->
                                        </div>
                                    <?php }
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="row row-skills">
                        <div class="skills">
                            <h3 class="title"><?php echo __('Kỹ năng', 'iz_theme'); ?></h3>
                            <?php
                            $skills = get_post_meta(get_the_ID(), 'iz-ch-skills', true);
                            $skills = ($skills == null) ? null : $skills;

                            if ($skills != null) {
                                foreach ($skills as $skill) {
                                    ?>
                                    <div class="col-sm-3 skill">
                                        <div class="icon">
                                            <div class="play" data-url='<?php echo $skill[4] ?>' data-toggle="modal" data-target=".video-modal-frame">
                                                <img src="<?php echo get_template_directory_uri() ?>/images/iz_images/videoicon.jpg" />
                                            </div>
                                            <!--<img src="<?php //echo $skill[0] ?>" />-->
                                        </div>
                                        <div class="name">
                                            <h4><img width="40" height="40" src="<?php echo $skill[0] ?>" style="display: inline-block;" /> <?php echo $skill[1] ?></h4>
                                        </div>
                                        <div class="meta">
                                            <span class="mana"><?php echo __('Năng lượng: ', 'iz_theme') . $skill[2]; ?></span> || 
                                            <span class="mana"><?php echo __('Thời gian hồi : ', 'iz_theme') . $skill[3]; ?></span>
                                        </div>
                                        <div class="skill-desc">
                                            <p>
                                                <?php echo $skill[5] ?>
                                            </p>
                                        </div>
                                    </div>

                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="content-details">
                        <h3 class="title"><?php echo __('Chi tiết', 'iz_theme'); ?></h3>
                        <?php the_content(); ?>
                    </div>

                    <?php
                endwhile;
            else:
                ?>
                <h1 class="entry-title">No post</h1>
            <?php endif; ?>
        </div>

    </div>


</div>


<div class="modal video-modal-frame" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo __('Video', 'iz_theme') ?></h4>
        </div>
        <div id="iz-frame">
            
        </div>
    </div>
  </div>
</div>



<?php get_footer(); ?>


