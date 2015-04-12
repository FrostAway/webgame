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
                    <div class="role"><?php the_taxonomies(array('title' => '')); ?></div>
                    <div class="row content">
                        <div class="col-sm-12 col-md-6 col-text">

                            <div class="indexs">
                                <h3 class="title"><?php echo __('Chỉ số', 'iz_theme') ?></h3>
                                <?php
                                $indexs = get_post_meta(get_the_ID(), 'iz-ch-indexs', true);
                                $indexs = ($indexs == null) ? null : $indexs;

                                $term_indexs = get_terms('fl_champion_index', array('hide_empty' => false));
                                foreach ($term_indexs as $index) {
                                    ?>
                                    <div class="index">
                                        <div class="icon" style="height: 72px; width: 62px;">

                                        </div>
                                        <div class="info">
                                            <div class="name">
                                                <?php echo $index->name ?>
                                            </div>
                                            <div class="value">
                                                <?php echo $indexs[$index->term_id][0] ?>
                                            </div>
                                            <div class="max">
                                                <div class="curr" style="width: <?php echo $indexs[$index->term_id][0] / 500 * 100 ?>%"></div>
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
                                <?php the_post_thumbnail('talent-page'); ?>
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
                                                    <img src="<?php echo $skin[0] ?>" title="<?php echo $skin[1] ?>" />
                                                </a>
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
                                            <img src="<?php echo $skill[0] ?>" />
                                        </div>
                                        <div class="name">
                                            <h3><?php echo $skill[1] ?></h3>
                                        </div>
                                        <div class="meta">
                                            <span class="mana"><?php echo __('Năng lượng: ', 'iz_theme') . $skill[2]; ?></span> || 
                                            <span class="mana"><?php echo __('Thời gian hồi : ', 'iz_theme') . $skill[3]; ?></span>
                                        </div>
                                        <div class="skill-desc">
                                            <p>
                                                <?php echo $skill[4] ?>
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

<?php get_footer(); ?>


