<?php
/*
 * Template Name: Load talent page
 */
?>

<?php if(isset($_POST['champion_id'])){ ?>
<?php $currch = get_post($_POST['champion_id']); ?>     

<div class="row detail-talent">
                    <div class="col-sm-12 col-md-4 index-info">
                        <div class="champion">
                            <a href="<?php //echo $currch->guid ?>">
                                <?php echo get_the_post_thumbnail($currch->ID, 'sb-post-thumbnail') ?>
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
                            foreach ($skills as $key => $skill) {
                                ?>
                            <div class="iz-skill" id="skill-<?php echo $key ?>">
                                    <div class="image">
                                        <img src="<?php echo $skill[0] ?>" width="40" height="40" />
                                    </div>
                                    <div class="info">
                                        <h3><?php echo $skill[1] ?> <span class="open-close pull-right">[+]</span></h3>
                                        <div class="meta">
                                            <span class="mana"><?php echo __('Năng lượng', 'iz_theme') . ': ' . $skill[2] ?></span>
                                            <span class="coldown"><?php echo __('Thời gian hồi', 'iz_theme') . ': ' . $skill[3]; ?></span>
                                        </div>
                                        <div class="add-text">
                                            
                                        </div>
                                        <div class="description">
                                            <div class="desc1">
                                                <?php echo $skill[5]; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-8 index-level">
                        <?php
                        $ch_indexs = get_terms('fl_champion_index', array('hide_empty' => false));
                        $myindexs = get_post_meta($currch->ID, 'iz-ch-indexs', true);
                        $myindexs = ($myindexs == null) ? null : $myindexs;
                        ?>
                        <div class="list-index row">
                            <?php foreach ($ch_indexs as $index) { ?>
                            <div class="col-sm-2 col-ind">
                                <div class="btn btn-success btn-block iz-index">
                                    <span class="value"><?php echo $myindexs[$index->term_id][0] ?></span>
                                    <input type="hidden" name="addlevel" class="iz-add-level" value="<?php echo $myindexs[$index->term_id][1]; ?>" />
                                    <input type="hidden" name="initvalue" class="iz-init-value" value="<?php echo $myindexs[$index->term_id][0]; ?>" />
                                    <span class="name"><?php echo $index->name ?></span>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div id="reset-talent"><button class="btn btn-sm btn-primary"><?php echo __('Reset', 'iz_theme') ?></button></div>
                        <div class="talent-image">
                            
                            <div class="talents">
                                <?php
                                $levels = array(1, 4, 7, 10, 13, 16, 20);
                                $tl_terms = get_the_terms($currch->ID, 'fl_talent_cat');
                                ?>
                                <?php foreach ($levels as $level){ ?>
                                <div class="level">
                                    <span class="level-num"> <?php echo $level ?> <span class="ind">(0)</span></span>
                                    <?php 
                                        $i = 0;
                                        if($tl_terms)
                                        foreach ($tl_terms as $term){ 
                                            $term_lv = get_option('talent-level'.$term->term_id);
                                            if($term_lv){
                                                if(in_array($level, $term_lv)){
                                                    $i++;
                                                   ?>
                                                    <a href="#" data-name="<?= $term->name ?>" data-num="<?= get_option('talent-skill'.$term->term_id); ?>" data-term="<?php echo $term->term_id ?>" data-index="<?php echo $i  ?>" data-title="<?php echo $term->description ?>">
                                                        <img src="<?php echo z_taxonomy_image_url($term->term_id); ?>" />
                                                        <div class="row tl-tooltip">
                                                            <div class="col-sm-2">
                                                                <?php z_taxonomy_image($term->term_id); ?>
                                                            </div>
                                                            <div class="col-sm-10">
                                                                <h4><?php echo $term->name ?></h4>
                                                                <p><?php echo $term->description  ?></p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                   <?php
                                                }
                                            }
                                        } 
                                    ?>
                                </div>
                                <?php } ?>
                            </div>
                            
                            <?php echo get_the_post_thumbnail($currch->ID, '', array('class'=>'talent-img')); ?>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
                </div>

<?php } ?>
