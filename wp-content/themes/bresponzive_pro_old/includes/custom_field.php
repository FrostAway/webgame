<?php

function iz_add_talent_field() {
    ?>

    <div class="form-field talent-champion">
        <label>Chọn tướng</label>
                <?php
                $champion = get_option('talent-champion' . $taxonomy->term_id);
                query_posts(array('post_type' => 'fl_champion', 'showposts'=>-1));
                ?>
                <select class="champion" name="talent-champion">
                    <option value="0">Select Champion</option>
                <?php if (have_posts()):while (have_posts()):the_post(); ?>
                    <option   value="<?php echo get_the_ID(); ?>" <?php selected(get_the_ID(), $champion, true); ?>> <?php the_title(); ?></option>
                        <?php
                    endwhile;
                    wp_reset_query();
                endif;
                ?>
                </select>
        <p>Chọn Tướng ứng với talent này.</p>
    </div>

    <div class="form-field talent-upgrade talent-skill-imp">
        <label><?php echo __('Kỹ năng', 'iz_theme'); ?></label>
        <div id="list-skills">
            <?php $champion = 1500; ?>
            <table>
                        <tr>
                            <th>Tên</th>
                            <th>Coldown</th>
                            <th>Lần nạp</th>
                            <th>New Skill</th>
                        </tr>
                    <?php
                    $skills = get_post_meta($champion, 'iz-ch-skills', true);
                    $skills = ($skills == null) ? null : $skills;
                    $currskills = get_option('talent-skill' . $taxonomy->term_id);
                    
                    if ($skills)
                        foreach ($skills as $key => $value) {
                            $check = '';
                            if (is_array($currskills)) {
                                    if (is_array($currskills['index']) && in_array($key, $currskills['index'])) {
                                        $check = 'checked';
                                    }
                            }
                            ?>
                            <tr>
                                <td><label><input class="skill" type="checkbox" name="talent-skill[index][]" value="<?php echo $key ?>" <?php echo $check; ?>  /> <?php echo $value[1]; ?></label></td>
                                <td style="width: 50px;"><input type="text" name="talent-skill[coldown][<?php echo $key ?>]" value="<?php if(is_array($currskills))  echo $currskills['coldown'][$key] ?>" /></td>
                                <td style="width: 50px;"><input type="text" name="talent-skill[base][<?php echo $key ?>]" value="<?php if(is_array($currskills))  echo $currskills['base'][$key] ?>" /></td>
                                <!--<td><input type="text" name="talent-skill[newskill][<?php //echo $key ?>]" value="<?php //if(is_array($currskills)) echo $currskills['newskill'][$key] ?>" /></td>-->
                                <td>
                                    <select name="talent-skill[newskill][<?php echo $key ?>]">
                                        <option value="0">Chọn Skill</option>
                                        <?php foreach ($skills as $key1=>$value1){ 
                                            if($value1[8] == 1){ 
                                                ?>
                                        <option value="<?php echo $key1 ?>" <?php selected($key1, $currskills['newskill'][$key], true); ?> ><?php echo $value1[1] ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </td>
                            </tr>
                        <?php }
                    ?>
                            </table>
        </div>
        <p>Kỹ năng bị tác động</p>
    </div>

    <div class="form-field talent-upgrade talent-index-imp">
        <label><?php echo __('Tác động Chỉ số', 'iz_theme') ?></label>

        <div id="list-indexs">
            <table>
                        <tr>
                            <th>Tên</th>
                            <th>Giá trị</th>
                        </tr>
                    <?php
                    $index_terms = get_terms('fl_champion_index', array('hide_empty' => false));
                    $currindexs = get_option('talent-index' . $taxonomy->term_id);
                    
                    foreach ($index_terms as $term) {
                        $check = '';
                        if (is_array($currindexs)) {
                            if (is_array($currindexs['term_id']) && in_array($term->term_id, $currindexs['term_id'])) {
                               $check = 'checked';
                            }
                        }
                        ?>
                        <tr>
                            <td><label><input class="index" type="checkbox" name="talent-index[term_id][]" value="<?php echo $term->term_id ?>" <?php echo $check; ?> /> <?php echo $term->name ?></label></td>
                            <td><label><input type="text" name="talent-index[value][<?php echo $term->term_id ?>]" value="<?php if(is_array($currindexs)) echo $currindexs['value'][$term->term_id] ?>" /></label></td>
                        </tr>

                    <?php }
                    ?>
                    </table>
        </div>
        <p>Chỉ số tác động (Giá trị âm nếu giảm)</p>
    </div>

    <div class="form-field talent-level">
        <label><?php echo __('Cấp độ tăng', 'iz_theme') ?></label>
        <div id="list-level">
            <?php
            $level = array(1, 4, 7, 10, 13, 16, 20);
            foreach ($level as $lv) {
                ?>
                <label><input type="checkbox" name="talent-level[]" value="<?php echo $lv ?>" /> Level <?php echo $lv; ?></label>
            <?php }
            ?>
        </div>
    </div>



    <script>
        (function ($) {
            $(document).ready(function () {
                $('.talent-champion .champion').change(function () {
                    $('.talent-upgrade #list-skills').html(' Loading .....');
                    var ch_id = $(this).val();
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo admin_url('admin-ajax.php') ?>',
                        data: {
                            action: 'load_champ_skill',
                            ch_id: ch_id
                        },
                        success: function (data) {
                            $('.talent-upgrade #list-skills').html(data);
                        }
                    });
                });

//                $('.talent-upgrade #list-skills .skill').click(function () {
//                    $('.talent-upgrade #list-indexs .index').prop('checked', false);
//                    $('#index-upgrade .index-upgrade').prop('disabled', true);
//                });
//                $('.talent-upgrade #list-indexs .index').click(function () {
//                    $('.talent-upgrade #list-skills .skill').prop('checked', false);
//                    $('#index-upgrade .index-upgrade').prop('disabled', false);
//                });
            });
        })(jQuery);
    </script>
    <?php
}

add_action('fl_talent_cat_add_form_fields', 'iz_add_talent_field', 10, 2);

function iz_edit_talent_field($taxonomy) {
    ?>
    <div class="form-field" id="talents">
        <!--<table class="talents-box" style="width: 100%;">-->
        <tr class="form-field talent-champion">
            <th><label for=""><?php echo __('Tướng', 'iz_theme') ?></label></th>
            <td id="list-champs" colspan="2">
                <?php
                $champion = get_option('talent-champion' . $taxonomy->term_id);
                query_posts(array('post_type' => 'fl_champion', 'showposts'=>-1));
                ?>
                <select class="champion" name="talent-champion">
                    <option value="0">Select Champion</option>
                <?php if (have_posts()):while (have_posts()):the_post(); ?>
                    <option   value="<?php echo get_the_ID(); ?>" <?php selected(get_the_ID(), $champion, true); ?>> <?php the_title(); ?></option>
                        <?php
                    endwhile;
                    wp_reset_query();
                endif;
                ?>
                </select>
            </td>
        </tr>
        <tr class="form-field talent-upgrade">
            <th><label><?php echo __('Tác động', 'iz_theme'); ?></label></th>

            <td>
                <label><strong><?php echo __('Kỹ năng', 'iz_theme'); ?></strong></label>
                <div id="list-skills">
                    <table>
                        <tr>
                            <th>Tên</th>
                            <th>Coldown</th>
                            <th>Lần nạp</th>
                            <th>New Skill</th>
                        </tr>
                    <?php
                    $skills = get_post_meta($champion, 'iz-ch-skills', true);
                    $skills = ($skills == null) ? null : $skills;
                    $currskills = get_option('talent-skill' . $taxonomy->term_id);
                    
                    if ($skills)
                        foreach ($skills as $key => $value) {
                            $check = '';
                            if (is_array($currskills)) {
                                    if (is_array($currskills['index']) && in_array($key, $currskills['index'])) {
                                        $check = 'checked';
                                    }
                            }
                            ?>
                            <tr>
                                <td><label><input class="skill" type="checkbox" name="talent-skill[index][]" value="<?php echo $key ?>" <?php echo $check; ?>  /> <?php echo $value[1]; ?></label></td>
                                <td><input type="text" name="talent-skill[coldown][<?php echo $key ?>]" value="<?php if(is_array($currskills))  echo $currskills['coldown'][$key] ?>" /></td>
                                <td><input type="text" name="talent-skill[base][<?php echo $key ?>]" value="<?php if(is_array($currskills))  echo $currskills['base'][$key] ?>" /></td>
                                <!--<td><input type="text" name="talent-skill[newskill][<?php //echo $key ?>]" value="<?php //if(is_array($currskills)) echo $currskills['newskill'][$key] ?>" /></td>-->
                                <td>
                                    <select name="talent-skill[newskill][<?php echo $key ?>]">
                                        <option value="0">Chọn Skill</option>
                                        <?php foreach ($skills as $key1=>$value1){ 
                                            if($value1[8] == 1){ 
                                                ?>
                                        <option value="<?php echo $key1 ?>" <?php selected($key1, $currskills['newskill'][$key], true); ?> ><?php echo $value1[1] ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </td>
                            </tr>
                        <?php }
                    ?>
                            </table>
                </div>
                <p class="description">Tích chọn các kỹ năng ảnh hưởng</p>
            </td>
        
            <td style="width: 300px;">
                <label><?php echo __('Chỉ số', 'iz_theme') ?></label>
                <div id="list-indexs">
                    <table>
                        <tr>
                            <th>Tên</th>
                            <th>Giá trị</th>
                        </tr>
                    <?php
                    $index_terms = get_terms('fl_champion_index', array('hide_empty' => false));
                    $currindexs = get_option('talent-index' . $taxonomy->term_id);
                    
                    foreach ($index_terms as $term) {
                        $check = '';
                        if (is_array($currindexs)) {
                            if (is_array($currindexs['term_id']) && in_array($term->term_id, $currindexs['term_id'])) {
                               $check = 'checked';
                            }
                        }
                        ?>
                        <tr>
                            <td><label><input class="index" type="checkbox" name="talent-index[term_id][]" value="<?php echo $term->term_id ?>" <?php echo $check; ?> /> <?php echo $term->name ?></label></td>
                            <td><label><input type="text" name="talent-index[value][<?php echo $term->term_id ?>]" value="<?php if(is_array($currindexs)) echo $currindexs['value'][$term->term_id] ?>" /></label></td>
                        </tr>

                    <?php }
                    ?>
                    </table>
                </div>
                <p class="description">Tích chọn các chỉ số ảnh hưởng</p>
            </td>
        </tr>

        <tr class="form-field talent-level">
            <th><?php echo __('Cấp độ tăng', 'iz_theme') ?></th>
            <td colspan="2">
                <?php
                $level = array(1, 4, 7, 10, 13, 16, 20);
                $tl_lv = get_option('talent-level' . $taxonomy->term_id);
                if ($tl_lv) {
                    foreach ($level as $lv) {
                        $check = '';
                        foreach ($tl_lv as $level) {
                            if ($lv == $level) {
                                $check = 'checked';
                                break;
                            }
                        }
                        ?>
                        <label style="display: inline-block;"><input <?php echo $check; ?> type="checkbox" name="talent-level[]" value="<?php echo $lv ?>" /> Level <?php echo $lv; ?></label>
                        <?php
                    }
                } else {
                    foreach ($level as $lv) {
                        ?>
                        <label style="display: block;"><input  type="checkbox" name="talent-level[]" value="<?php echo $lv ?>" /> Level <?php echo $lv; ?></label>
                            <?php
                        }
                    }
                    ?>
            </td>
        </tr>
    <!--            <tr>
            <th><label><?php //echo __('Chi tiết tác động', 'iz_theme')         ?></label></th>
            <td colspan="2">
                <textarea name="talent-content" cols="80" rows="4"><?php //echo get_option('talent-content'.$taxonomy->term_id)         ?></textarea>
            </td>
        </tr>-->
        <!--</table>-->
        <script>
            (function ($) {
            $(document).ready(function () {
                $('.talent-champion .champion').change(function () {
                    $('.talent-upgrade #list-skills').html(' Loading .....');
                    var ch_id = $(this).val();
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo admin_url('admin-ajax.php') ?>',
                        data: {
                            action: 'load_champ_skill',
                            ch_id: ch_id
                        },
                        success: function (data) {
                            $('.talent-upgrade #list-skills').html(data);
                        }
                    });
                });

//                $('.talent-upgrade #list-skills .skill').click(function () {
//                    $('.talent-upgrade #list-indexs .index').prop('checked', false);
//                    $('#index-upgrade .index-upgrade').prop('disabled', true);
//                });
//                $('.talent-upgrade #list-indexs .index').click(function () {
//                    $('.talent-upgrade #list-skills .skill').prop('checked', false);
//                    $('#index-upgrade .index-upgrade').prop('disabled', false);
//                });
            });
        })(jQuery);
        </script>
    </div>
    <?php
}

add_action('fl_talent_cat_edit_form_fields', 'iz_edit_talent_field', 10, 2);

add_filter('manage_fl_talent_cat_custom_column', 'iz_talent_column', 10, 3);

function iz_talent_column() {
    
}

add_action('create_term', 'iz_save_talent_field');
add_action('edit_term', 'iz_save_talent_field');

function iz_save_talent_field($term_id) {

    if (isset($_POST['talent-champion'])) {
        update_option('talent-champion' . $term_id, $_POST['talent-champion']);
        wp_set_object_terms($_POST['talent-champion'], $term_id, 'fl_talent_cat', true);
    }
    if (isset($_POST['talent-index'])) {
        update_option('talent-index' . $term_id, $_POST['talent-index']);
    } else {
        update_option('talent-index' . $term_id, null);
    }
    if (isset($_POST['ug-talent-index'])) {
        update_option('ug-talent-index' . $term_id, $_POST['ug-talent-index']);
    }
    if (isset($_POST['talent-skill'])) {
        update_option('talent-skill' . $term_id, $_POST['talent-skill']);
    } else {
        update_option('talent-skill' . $term_id, null);
    }
    if (isset($_POST['talent-content'])) {
        update_option('talent-content' . $term_id, $_POST['talent-content']);
    }
    if (isset($_POST['talent-level'])) {
        update_option('talent-level' . $term_id, $_POST['talent-level']);
    }
}
