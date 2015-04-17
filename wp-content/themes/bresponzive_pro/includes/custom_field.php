<?php

function iz_add_talent_field() {
    ?>
    <div class="form-field" id="talents">
        <table class="talents-box" style="width: 100%;">
            <tr>
                <th><label for=""><?php echo __('Tướng', 'iz_theme') ?></label></th>
                <td colspan="2">
                    <div id="list-champs">
                        <?php query_posts(array('post_type' => 'fl_champion')); ?>
                        <?php if (have_posts()):while (have_posts()):the_post(); ?>
                                <div><label><input class="champion" type="radio" name="talent-champion" value="<?php echo get_the_ID(); ?>" /> <?php the_title(); ?></label></div>

                                <?php
                            endwhile;
                            wp_reset_query();
                        endif;
                        ?>
                    </div>
                </td>
            </tr>
            <tr>
                <th><label><?php echo __('Tác động', 'iz_theme') ?></label></th>
                
                <td>
                    <label><?php echo __('Kỹ năng', 'iz_theme'); ?></label>
                    <div id="list-skills">
                        <?php
                        $skills = get_post_meta(1114, 'iz-ch-skills', true);
                        $skills = ($skills == null) ? null : $skills;
                        if ($skills != null) {
                            foreach ($skills as $key => $value) {
                                ?>
                                <div><label><input type="radio" name="talent-skill" value="<?php echo $key ?>" /> <?php echo $value[1] ?></label></div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </td>
            </tr>
            <tr>
                <th><?php echo __('Cấp độ tăng', 'iz_theme') ?></th>
                <td colspan="2">
                    <?php
                    $level = array(1, 4, 7, 10, 13, 16, 20);
                    foreach ($level as $lv) {
                        ?>
                        <label><input type="checkbox" name="talent-level[]" value="<?php echo $lv ?>" /> Level <?php echo $lv; ?></label>
                    <?php }
                    ?>
                </td>
            </tr>
    <!--            <tr>
                <th><label><?php //echo __('Chi tiết tác động', 'iz_theme')   ?></label></th>
                <td colspan="2">
                    <textarea name="talent-content" cols="4"></textarea>
                </td>
            </tr>-->
        </table>
        <script>
            (function ($) {
                $(document).ready(function () {
                    $('#talents #list-champs .champion').click(function () {

                        if ($(this).is(':checked')) {
                            $('#talents #list-skills').html(' Loading .....');
                            
                            var ch_id = $(this).val();
                            $.ajax({
                                type: 'POST',
                                url: '<?php echo admin_url('admin-ajax.php') ?>',
                                data: {
                                    action: 'load_champ_skill',
                                    ch_id: ch_id
                                },
                                success: function (data) {
                                    $('#talents #list-skills').html(data);
                                }
                            });
                        } else {
                        }
                    });
                });
            })(jQuery);
        </script>
    </div>
    <?php
}

add_action('fl_talent_cat_add_form_fields', 'iz_add_talent_field', 10, 2);

function iz_edit_talent_field($taxonomy) {
    ?>
    <div class="form-field" id="talents">
        <table class="talents-box" style="width: 100%;">
            <tr>
                <th><label for=""><?php echo __('Tướng', 'iz_theme') ?></label></th>
                <td id="list-champs" colspan="2">
                    <?php
                    $champion = get_option('talent-champion' . $taxonomy->term_id);
                    query_posts(array('post_type' => 'fl_champion'));
                    ?>
                    <?php if (have_posts()):while (have_posts()):the_post(); ?>
                            <div><label><input class="champion" type="radio" name="talent-champion" value="<?php echo get_the_ID(); ?>" <?php checked(get_the_ID(), $champion, true); ?>  /> <?php the_title(); ?></label></div>

                            <?php
                        endwhile;
                        wp_reset_query();
                    endif;
                    ?>
                </td>
            </tr>
            <tr>
                <th><label><?php echo __('Tác động', 'iz_theme'); ?></label></th>
<!--                <td  style="width: 200px;">
                    <label><strong><?php // echo __('Chỉ số', 'iz_theme'); ?></strong></label>
                    <div class="list-terms">
                        <?php //$index_terms = get_terms('fl_champion_index', array('hide_empty' => false)); ?>
                        <?php //foreach ($index_terms as $term) { ?>
                            <div><label><input type="radio" name="talent-index" value="<?php // echo $term->term_id ?>" <?php //checked($term->term_id, get_option('talent-index' . $taxonomy->term_id), true); ?>  />  <?php //echo $term->name; ?></label></div>
                        <?php //} ?>
                    </div>
                </td>-->
                <td>
                    <label><strong><?php echo __('Kỹ năng', 'iz_theme'); ?></strong></label>
                    <div id="list-skills">
                        <?php
                        $skills = get_post_meta($champion, 'iz-ch-skills', true);
                        $skills = ($skills == null) ? null : $skills;
                        if ($skills)
                            foreach ($skills as $key => $value) {
                                ?>
                                <div>
                                    <label><input type="radio" name="talent-skill" value="<?php echo $key ?>" <?php checked($key, get_option('talent-skill' . $taxonomy->term_id), true); ?> /> <?php echo $value[1]; ?></label>
                                </div>
                            <?php }
                        ?>
                    </div>
                </td>
            </tr>
            <tr>
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
                            <label style="display: block;"><input <?php echo $check; ?> type="checkbox" name="talent-level[]" value="<?php echo $lv ?>" /> Level <?php echo $lv; ?></label>
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
                <th><label><?php //echo __('Chi tiết tác động', 'iz_theme')   ?></label></th>
                <td colspan="2">
                    <textarea name="talent-content" cols="80" rows="4"><?php //echo get_option('talent-content'.$taxonomy->term_id)   ?></textarea>
                </td>
            </tr>-->
        </table>
        <script>
            jQuery(document).ready(function ($) {
                $('#list-champs .champion').click(function () {
                    if ($(this).is(':checked')) {
                        $('#talents #list-skills').html(' Loading .....');
                        var ch_id = $(this).val();
                        $.ajax({
                            type: 'POST',
                            url: '<?php echo admin_url('admin-ajax.php') ?>',
                            data: {
                                action: 'load_champ_skill',
                                ch_id: ch_id
                            },
                            success: function (data) {
                                $('.talents-box #list-skills').html(data);
                            }
                        });
                    } else {
                    }
                });
            });
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
    }
    if (isset($_POST['talent-skill'])) {
        update_option('talent-skill' . $term_id, $_POST['talent-skill']);
    }
    if (isset($_POST['talent-content'])) {
        update_option('talent-content' . $term_id, $_POST['talent-content']);
    }
    if (isset($_POST['talent-level'])) {
        update_option('talent-level' . $term_id, $_POST['talent-level']);
    }
}
