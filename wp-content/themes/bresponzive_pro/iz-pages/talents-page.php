<?php
/*
 * Template Name: Talents page
 */
?>

<?php get_header(); ?>
<!--#blocks-wrapper-->
<div id="blocks-wrapper" class="clearfix">

    <div id="game-guide">

        <div class="post-content">
            <h1 class="entry-title"><?php the_title(); ?></h1>

            <?php
            $champions = get_posts(array(
                'post_type' => 'fl_champion',
                'hide_empty' => false,
                'showposts' => -1
            ));
            ?>
            <div class="list-champions" id="list-champions">
                <?php foreach ($champions as $ch) { ?>
                    <div class="iz-champion">
                        <a href="#" data-id="<?php echo $ch->ID ?>" title="<?php echo $ch->post_title ?>">
                            <img src="<?php echo get_post_meta($ch->ID, 'iz-ch-face', true); ?>" />
                        </a>
                    </div>
                <?php } ?>
            </div>

            <hr />
            <?php $currch = get_posts(array('post_type' => 'fl_champion', 'showposts' => 1))[0]; ?>           
            
            <div id="talent-loading">
                <img width="50" height="50" src="<?php echo get_template_directory_uri() ?>/images/loader33.gif" />
            </div>
            <div id="load-talent-detail">
                <div class="row detail-talent">
                    <div class="col-sm-12 col-md-5 index-info">
                        <div class="champion">
                            <a href="<?php //echo $currch->guid ?>">
                                <?php echo get_the_post_thumbnail($currch->ID, 'ch-guide') ?>
                                <strong><?php echo $currch->post_title ?></strong>
                            </a>
                            <div class="clearfix"></div>
                        </div>
                        <strong>Level: </strong><div id="range">

                        </div> <strong id="range-value">1</strong>
                        <div class="list-skill">
                            <?php
                            $skills = get_post_meta($currch->ID, 'iz-ch-skills', true);
                            $skills = ($skills == null) ? null : $skills;
                            if($skills != null)
                            foreach ($skills as $skill) {
                                ?>
                                <div class="iz-skill">
                                    <div class="image">
                                        <img src="<?php echo $skill[0] ?>" width="40" height="40" />
                                    </div>
                                    <div class="info">
                                        <h3><?php echo $skill[1] ?></h3>
                                        <div class="meta">
                                            <span class="mana"><?php echo __('Năng lượng', 'iz_theme') . ': ' . $skill[2] ?></span>
                                            <span class="coldown"><?php echo __('Thời gian hồi', 'iz_theme') . ': ' . $skill[3]; ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-7 index-level">
                        <?php
                        $ch_indexs = get_terms('fl_champion_index', array('hide_empty' => false));
                        $myindexs = get_post_meta($currch->ID, 'iz-ch-indexs', true);
                        $myindexs = ($myindexs == null) ? null : $myindexs;
                        ?>
                        <div class="list-index row">
                            <?php foreach ($ch_indexs as $index) { ?>
                            <div class="col-sm-3">
                                <div class="btn btn-success btn-block iz-index">
                                    <span class="value"><?php echo $myindexs[$index->term_id][0] ?></span>
                                    <input type="hidden" name="addlevel" class="iz-add-level" value="<?php echo $myindexs[$index->term_id][1]; ?>" />
                                    <input type="hidden" name="initvalue" class="iz-init-value" value="<?php echo $myindexs[$index->term_id][0]; ?>" />
                                    <span class="name"><?php echo $index->name ?></span>
                                </div>
                            </div>
                            <?php } ?>
                        </div>

                        <div class="talent-image">
                            <?php echo get_the_post_thumbnail($currch->ID, ''); ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr />
                </div>
            </div>
        </div>

    </div>


</div>

<?php get_footer(); ?>

