<?php
/*
 * Template Name: load create hero guide
 */
?>
<?php if (isset($_POST['champion_id'])) { ?>
    <?php $currch = get_post($_POST['champion_id']); ?>     

    <div id="load-hero-talent" role="tabpanel">
        <div class="row detail-talent">
            <div class="index-info">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Talent Build</a></li>
                    <!--<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Bản đồ</a></li>-->
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <div class="talent-image">

                            <div class="talents">
                                <?php
                                $tl_terms = get_the_terms($currch->ID, 'fl_talent_cat');

                                $levels = array(1, 4, 7, 10, 13, 16, 20);
                                $j = 0;
                                foreach ($levels as $level) {
                                    ?>
                                    <div class="level" id="level-<?= $level ?>" >
                                        <span class="level-num" style="width: 90px;">Level <?php echo $level ?></span>
                                        <?php
                                        $i = 0;
                                        foreach ($tl_terms as $term) {

                                            $term_lv = get_option('talent-level' . $term->term_id);

                                            if ($term_lv) {
                                                if (in_array($level, $term_lv)) {
                                                    $i++;
                                                    ?>
                                                    <a href="#" 
                                                       data-tier="<?= $level ?>"
                                                       data-name="<?= $term->name ?>" 
                                                       data-title="<?php echo $term->description ?>"
                                                       data-pos="<?= $i ?>">
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
                                                        <input class="talent_value"  type="checkbox" name="talent_stt[<?= $level ?>][]" />
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

                        </div>
                    </div>
                    <!--<div role="tabpanel" class="tab-pane" id="profile">...</div>-->
                </div>
            </div>
        </div>
    </div>

<?php } ?>