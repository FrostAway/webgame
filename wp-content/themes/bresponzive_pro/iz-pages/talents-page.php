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

            <?php $currch = get_post(6); ?>           
            
            <div id="talent-loading">
                <img width="50" height="50" src="<?php echo get_template_directory_uri() ?>/images/loader33.gif" />
            </div>
            <div id="load-talent-detail">
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
                        <?php global $wp;
                        $current_url = home_url(add_query_arg(array(), $wp->request)) ;
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
                                $levels = array(1, 4, 7, 10, 13, 16, 20);
                                $tl_terms = get_the_terms($currch->ID, 'fl_talent_cat');
                                
                                if(isset($_GET['stt'])){
                                    $stt = $_GET['stt'];
                                }else{
                                    $stt = '';
                                }
                                
                                ?>
                                <?php 
                                $j = 0;
                                foreach ($levels as $level){
                                    ?>
                                <div class="level">
                                    <span class="level-num"> <?php echo $level ?> <span class="ind">(0)</span></span>
                                    <?php 
                                        $i = 0;
                                        foreach ($tl_terms as $term){ 
                                            
                                            $num_ch = get_option('talent-skill'.$term->term_id);
//                                           
                                            $term_lv = get_option('talent-level'.$term->term_id);
                                            if($term_lv){
                                                if(in_array($level, $term_lv)){
                                                    $i++;
                                                   ?>
                                                    <a href="#" data-name="<?= $term->name ?>" data-num="<?= $num_ch ?>" data-term="<?php echo $term->term_id ?>" data-index="<?php echo $i  ?>" data-title="<?php echo $term->description ?>"
                                                       class="<?php if($stt!=''){
                                                           if($stt[$j] != 0){
                                                           if($stt[$j] == $i){
                                                               echo 'active';
                                                           }else{
                                                               echo 'none';
                                                           }
                                                           }
                                                       } ?>" >
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
                                <?php
                                   $j++; } ?>
                            </div>
                            
                            <?php echo get_the_post_thumbnail($currch->ID, '', array('class'=>'talent-img')); ?>
                            
                            <div class="bbcode">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">BBCODE</span>
                                    <input type="text" id="bbcode" class="form-control" placeholder="bbcode" aria-describedby="basic-addon1" value="[embed=<?php echo $_SERVER['REQUEST_URI'] ?>]" >
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

    </div>


</div>

<?php get_footer(); ?>

