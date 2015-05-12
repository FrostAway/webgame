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
                'showposts' => -1,
				'orderby' => 'title',
				'order' => 'ASC'
            ));
            ?>
            <div class="list-champions" id="list-champions">
                <?php foreach ($champions as $ch) { ?>
                    <div class="iz-champion <?php if($ch->ID == 1350) echo 'ch-select'; ?>">
                        <a href="#" data-id="<?php echo $ch->ID ?>" title="<?php echo $ch->post_title ?>">
                            <img src="<?php echo get_post_meta($ch->ID, 'iz-ch-face', true); ?>" />
                        </a>
                    </div>
                <?php } ?>
            </div>

            <?php $currch = get_post(1350); ?>           

            <div id="talent-loading">
                <img width="50" height="50" src="<?php echo get_template_directory_uri() ?>/images/loader33.gif" />
            </div>
            <div id="load-talent-detail">
                <div class="row detail-talent">
                    <div class="col-sm-12 col-md-4 index-info">
                        <div class="champion">
                            <a href="<?php //echo $currch->guid       ?>">
                                <?php echo get_the_post_thumbnail($currch->ID, 'sb-post-thumbnail') ?>
                                <strong><?php echo $currch->post_title ?></strong>
                            </a>
                            <div class="clearfix"></div>
                        </div>
                        <strong>Level: </strong><div id="range">

                        </div> <strong id="range-value">1</strong>
                        <div class="list-skill">
                            <?php
                            $levels = array(1, 4, 7, 10, 13, 16, 20);

                            $skills = get_post_meta($currch->ID, 'iz-ch-skills', true);
                            $skills = ($skills == null) ? null : $skills;
                            if ($skills != null)
                                foreach ($skills as $key => $skill) {
                                    ?>
                                    <div <?php if($skill[8] == 1) echo 'class="iz-skill skill-hide hide-status" data-current=""'; else echo 'class="iz-skill"'; ?> id="skill-<?php echo $key ?>">
                                        <div class="image">
                                            <img src="<?php echo $skill[0] ?>" width="40" height="40" />
                                            <?php if(is_numeric($skill[6])){ ?>
                                            <span class="base">
                                                <span class="x-bol">x</span><span class="base-num"><?php echo $skill[6] ?></span>
                                                <input type="hidden" class="base-default" value="<?php echo $skill[6]; ?>" />
                                            </span>
                                            <?php } ?>
                                        </div>
                                        <div class="info">
                                            <h3><?php echo $skill[1] ?> <span class="open-close pull-right">[+]</span></h3>
                                            <div class="meta">
                                                <span class="mana"><?php if(is_numeric($skill[2])) echo __('Mana: ', 'iz_theme') . '' . $skill[2]; else echo $skill[2]; ?></span>
                                                <span class="coldown">
                                                    <?php if(is_numeric($skill[6])){ echo __('Thời gian nạp: ', 'iz_theme').'<span class="chager-col">'.$skill[7].'</span>s'; 
                                                    ?><input type="hidden" class="chager-col-default" value="<?php echo $skill[7] ?>" /><?php
                                                    } else {
                                                        if(is_numeric($skill[3])){
                                                            echo __('Thời gian hồi', 'iz_theme') . ': ' . $skill[3].'s';
                                                        }
                                                    } ?>
                                                </span>
                                            </div>
                                            <div class="add-text">
                                                <?php foreach ($levels as $lv) { ?>
                                                    <div class="at-lv-<?php echo $lv ?>"></div>
                                                <?php } ?>
                                            </div>
                                            <div class="description">
                                                <div class="desc1">
                                                    <?php echo $skill[5]; ?>
                                                </div>
                                                <div class="desclv">
                                                    <?php foreach ($levels as $lv) { ?>
                                                        <div class="desclv-<?php echo $lv ?>"></div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-8 index-level">

                        <?php
                        $ch_indexs = get_the_terms($currch->ID, 'fl_champion_index');
                        $myindexs = get_post_meta($currch->ID, 'iz-ch-indexs', true);
                        $myindexs = ($myindexs == null) ? null : $myindexs;
                        ?>
                        <div class="list-index row">
                            <?php foreach ($ch_indexs as $index) {
                                if($ch_indexs){
                                if($index->term_id != 412){?>
                                <div class="col-sm-2 col-ind">
                                    <div class="btn btn-success btn-block iz-index" id="iz-index-<?php echo $index->term_id ?>">
                                        <span class="value"><?php echo $myindexs[$index->term_id][0] ?></span>
                                        <input type="hidden" name="addlevel" class="iz-add-level" value="<?php echo $myindexs[$index->term_id][1]; ?>" />
                                        <input type="hidden" name="initvalue" class="iz-init-value" value="<?php echo $myindexs[$index->term_id][0]; ?>" />
                                        <input type="hidden" name="currvalue" class="iz-curr-value" value="<?php echo $myindexs[$index->term_id][0]; ?>" />
                                        <span class="name"><?php echo $index->name ?></span>
                                    </div>
                                </div>
                            <?php } } } ?>
                        </div>
                        <?php
                        global $wp;
                        $current_url = home_url(add_query_arg(array(), $wp->request));
                        ?>
                        <div id="reset-talent"><button class="btn btn-sm btn-danger"><?php echo __('Reset', 'iz_theme') ?></button></div>
                        <input id="share-talent-url" type="text" name="share-talent" value="<?php echo $current_url ?>" />
                        <div class="share-btn">
                            <a class="btn btn-sm btn-primary" target="_new" data-href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $current_url ?>" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $current_url ?>"><?php echo __('Chia sẻ', 'iz_theme') ?></a>
                        </div>
                        <input type="hidden" id="talent-path" value="<?php echo $_SERVER['PHP_SELF'] ?>" />

                        <div class="talent-image">

                            <div class="talents">
                                <?php
                                $tl_terms = get_the_terms($currch->ID, 'fl_talent_cat');

                                if (isset($_GET['stt'])) {
                                    $stt = $_GET['stt'];
                                } else {
                                    $stt = '';
                                }
                                ?>
                                <?php
                                $j = 0;
                                foreach ($levels as $level) {
                                    ?>
                                    <div class="level" id="level-<?= $level ?>" >
                                        <span class="level-num"> <?php echo $level ?> <span class="ind">(0)</span></span>
                                        <?php
                                        $i = 0;
                                        foreach ($tl_terms as $term) {

                                            $term_lv = get_option('talent-level' . $term->term_id);

                                            if ($term_lv) {
                                                if (in_array($level, $term_lv)) {
                                                    $i++;
                                                    $talent_skills = get_option('talent-skill' . $term->term_id);
                                                    $data_skill = array();
                                                    $data_base = array();
                                                    $data_coldown = array();
                                                    $data_new = array();
                                                    if (is_array($talent_skills) && is_array($talent_skills['index'])) {
                                                        $data_skill = $talent_skills['index'];
                                                        if(is_array($talent_skills['coldown'])){
                                                            $data_coldown = $talent_skills['coldown'];
                                                        }
                                                        if(is_array($talent_skills['base'])){
                                                            $data_base = $talent_skills['base'];
                                                        }
                                                        if(is_array($talent_skills['newskill'])){
                                                            $data_new = $talent_skills['newskill'];
                                                        }
                                                    }
                                                    $term_index = get_option('talent-index' . $term->term_id);
                                                    $data_term_index = array();
                                                    $data_ug_index = array();
                                                    if (is_array($term_index) && is_array($term_index['term_id'])) {
                                                        $data_term_index = $term_index['term_id'];
                                                        if (is_array($term_index['value'])) {
                                                            $data_ug_index = $term_index['value'];
                                                        }
                                                    }
                                                    ?>
                                                    <a href="#" 
                                                       data-tier="<?= $level ?>"
                                                       data-name="<?= $term->name ?>" 
                                                       data-skill='<?= json_encode($data_skill); ?>' 
                                                       data-index-term='<?= json_encode($data_term_index) ?>' 
                                                       data-ug-index='<?= json_encode($data_ug_index); ?>'
                                                       data-talent="<?php echo $term->term_id ?>" 
                                                       data-pos="<?php echo $i ?>" 
                                                       data-base='<?= json_encode($data_base) ?>' 
                                                       data-coldown='<?= json_encode($data_coldown) ?>' 
                                                       data-new='<?= json_encode($data_new) ?>'
                                                       data-title="<?php echo $term->description ?>"
                                                       class="<?php
                                                       if ($stt != '') {
                                                           if ($stt[$j] != 0) {
                                                               if ($stt[$j] == $i) {
                                                                   echo 'active';
                                                               } else {
                                                                   echo 'none';
                                                               }
                                                           }
                                                       }
                                                       ?>" >
                                                        <img src="<?php echo z_taxonomy_image_url($term->term_id); ?>" />
                                                        <div class="row tl-tooltip">
                                                            <div class="col-sm-2">
                                                                <?php z_taxonomy_image($term->term_id); ?>
                                                            </div>
                                                            <div class="col-sm-10">
                                                                <h4><?php echo $term->name ?></h4>
                                                                <p><?php echo $term->description ?></p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    $j++;
                                }
                                ?>
                            </div>
                            <div class="bbcode">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">BBCODE</span>
                                    <input type="text" id="bbcode" class="form-control" placeholder="bbcode" aria-describedby="basic-addon1" value="[embed=<?php echo $_SERVER['REQUEST_URI'] ?>]" >
                                </div>
                            </div>

                            <?php echo get_the_post_thumbnail($currch->ID, '', array('class' => 'talent-img')); ?>

                            
                        </div>

                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

    </div>


</div>

<?php get_footer(); ?>

