<?php

function fl_add_post_type() {
    register_post_type('fl_champion', array(
        'labels' => array(
            'name' => 'Tướng',
            'singular_name' => 'Tướng',
            'add_new' => 'Thêm tướng mới',
            'edit_item' => 'Chỉnh sửa tướng',
            'all_items' => 'Tất cả tướng',
            'new_item_name' => 'Tướng mới',
            'view_item' => 'Xem tướng',
            'menu_name' => 'Tướng',
            'add_new_item' => 'Thêm thướng mới',
        ),
        'description' => 'Tướng trong game',
        'supports' => array(
            'title', 'thumbnail', 'editor', 'comments', 'excerpt'
        ),
        'hierarchical' => true,
        'has_archive' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => false,
        'show_in_admin_bar' => false,
        'menu_position' => 7,
        'menu_icon' => 'dashicons-visibility',
    ));

    register_taxonomy('fl_media_cat', 'attachment', array(
        'labels' => array(
            'name' => 'Danh mục Media',
            'singular_name' => 'Danh mục Media',
            'add_new' => 'Thêm Danh mục',
            'new_item_name' => 'Danh mục Media mới',
            'add_new_item' => 'Thêm danh mục Media'
        ),
        'public' => true,
        'hierarchical' => true,
        'has_archive' => true,
        'show_admin_column' => true,
        'rewirte' => array('slug' => 'media-cat'),
        'query_var' => true
    ));

    register_taxonomy('fl_champion_cat', 'fl_champion', array(
        'labels' => array(
            'name' => 'Danh mục Tướng',
            'singular_name' => 'Danh mục Tướng',
            'add_new' => 'Thêm Danh mục',
            'new_item_name' => 'Danh mục Tướng mới',
            'add_new_item' => 'Thêm danh mục Tướng'
        ),
        'public' => true,
        'hierarchical' => true,
        'show_admin_column' => true,
        'rewirte' => array('slug' => 'champion_cat'),
        'query_var' => true
    ));

    register_taxonomy('fl_champion_index', 'fl_champion', array(
        'labels' => array(
            'name' => 'Chỉ số Tướng',
            'singular_name' => 'Chỉ số Tướng',
            'add_new' => 'Thêm chỉ số',
            'new_item_name' => 'Chỉ số mới',
            'add_new_item' => 'Thêm chỉ số mới'
        ),
        'public' => true,
        'hierarchical' => false,
        'show_admin_column' => false,
        'query_var' => false
    ));


    register_post_type('fl_guide', array(
        'labels' => array(
            'name' => __('Game Guide', 'iz_theme'),
            'singular_name' => __('Game Guide', 'iz_theme'),
            'add_new' => __('New Guide', 'iz_theme'),
            'edit_item' => __('Edit Guide', 'iz_theme'),
            'all_items' => __('All Guide', 'iz_theme'),
            'new_item_name' => __('New Guide', 'iz_theme'),
            'view_item' => __('View Guide', 'iz_theme'),
            'menu_name' => __('Game Guide', 'iz_theme'),
            'add_new_item' => __('Add new Guide', 'iz_theme'),
        ),
        'description' => __('Hướng dẫn mọi thứ trong game', 'iz_theme'),
        'supports' => array(
            'title', 'thumbnail', 'editor', 'comments', 'excerpt'
        ),
        'hierarchical' => true,
        'has_archive' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => false,
        'show_in_admin_bar' => false,
        'menu_position' => 6,
        'menu_icon' => 'dashicons-book',
    ));
    register_taxonomy('fl_guide_cat', 'fl_guide', array(
        'labels' => array(
            'name' => __('Danh mục Guide', 'iz_theme'),
            'singular_name' => __('Danh mục Guide', 'iz_theme'),
            'add_new' => __('Thêm Danh mục', 'iz_theme'),
            'new_item_name' => __('Danh mục mới', 'iz_theme'),
            'add_new_item' => __('Thêm danh mục Guide', 'iz_theme'),
        ),
        'public' => true,
        'hierarchical' => true,
        'show_admin_column' => true,
        'rewirte' => array('slug' => 'guide_cat'),
        'query_var' => true
    ));
}

add_action('init', 'fl_add_post_type');

add_action('add_meta_boxes', 'fl_add_champion_fields');

function fl_add_champion_fields() {

    add_meta_box('fl-champion-ind', __('Chỉ số tướng', 'iz_theme'), 'fl_champion_ind', 'fl_champion', 'normal', 'high', array());
    add_meta_box('fl-champion-skill', __('Kỹ năng', 'iz_theme'), 'fl_champion_skill', 'fl_champion', 'normal', 'high', array());
    add_meta_box('fl-champion-gallery', __('Hình ảnh tướng', 'iz_theme'), 'fl_champion_gallery', 'fl_champion', 'side', 'low', array());
    add_meta_box('fl-champion-skin', __('Ngoại Trang', 'iz_theme'), 'fl_champion_skin', 'fl_champion', 'normal', 'high', array());
}

function fl_champion_ind($post) {
    $ch_inds = get_post_meta($post->ID, 'iz-ch-indexs', true);
    $ch_inds = ($ch_inds == null) ? null : $ch_inds;
    ?>
    <div id="champion-ind">
        <table class="champion-ind-table">
            <?php
            $index_cats = get_terms('fl_champion_index', array('hide_empty' => false));
            ?>
            <tr>
                <th><?php echo __('Tên', 'iz_theme') ?></th>
                <th><?php echo __('Chỉ số', 'iz_theme') ?></th>
                <th><?php echo __('Cộng mỗi level', 'iz_theme') ?></th>
            </tr>
            <?php
            foreach ($index_cats as $tax) {
                ?>
                <tr class="index">
                    <td><?= $tax->name ?></td>
                    <td><input type="number" name="iz-ch-indexs[<?= $tax->term_id ?>][]" value="<?php if ($ch_inds != null) echo $ch_inds[$tax->term_id][0] ?>" /></td>
                    <td><input type="number" name="iz-ch-indexs[<?= $tax->term_id ?>][]" value="<?php if ($ch_inds != null) echo $ch_inds[$tax->term_id][1] ?>" /></td>
                </tr>
                <?php
            }
            ?>

        </table>
    </div>
    <?php
}

function fl_champion_ind_old($post) {
    $ch_inds = get_post_meta($post->ID, 'iz-ch-indexs', true);
    $ch_inds = ($ch_inds == null) ? null : $ch_inds;
    ?>
    <div id="champion-ind">
        <select id="select-level" post-id="<?= $post->ID ?>">
            <?php for ($k = 1; $k <= 5; $k++) { ?>
                <option value="<?= $k ?>">Level <?= $k ?></option>
            <?php } ?>
        </select>
        <button class="button" id="ind-select-save"><?php echo __('Lưu lại', 'iz_theme') ?></button>

        <?php for ($i = 0; $i < 5; $i++) { ?>
            <table class="champion-ind-table level-<?= $i + 1 ?>">
                <?php
                $index_cats = get_terms('fl_champion_index', array('hide_empty' => false));
                foreach ($index_cats as $tax) {
                    ?>
                    <tr class="index">
                        <td><?= $tax->name ?></td>
                        <td><input type="text" name="iz-ch-indexs[<?= $i ?>][<?= $tax->term_id ?>]" value="<?php echo $ch_inds[$i][$tax->term_id] ?>" /></td>
                    </tr>
                    <?php
                }
                ?>

            </table>
        <?php } ?>
        <a href="#" class="button">Thêm chỉ số</a>
        <input type="hidden" name="iz-champion-ind" value="1" />
    </div>
    <?php
}

function fl_champion_skill($post) {
    $ch_skills = get_post_meta($post->ID, 'iz-ch-skills', true);
    $ch_skills = ($ch_skills == null) ? null : $ch_skills;
    ?>
    <div id="champion-skill">
        <table class="iz-setting-box" style="width: 100%">
            <tr>
                <th><?php ?></th>
                <th><?php echo __('Hình ảnh', 'iz_theme') ?></th>
                <th><?php echo __('Tên', 'iz_theme') ?></th>
                <th><?php echo __('Dùng Mana', 'iz_theme') ?></th>
                <th><?php echo __('T/G Hồi', 'iz_theme') ?></th>
                <th><?php echo __('Mô tả', 'iz_theme') ?></th>
            </tr>
            <?php
            if ($ch_skills != null) {
                $i = 0;
                ?>
                <?php foreach ($ch_skills as $skill) { ?>
                    <tr class="iskill">
                        <th><span class="dashicons dashicons-arrow-right-alt2"></span></th>
                        <td class="icon">
                            <a class="icon-image" href="#"><img height="80" width="80" src="<?php echo $skill[0] ?>" /></a>
                            <input type="hidden" class="iz-ch-skill-url" name="iz-ch-skills[<?= $i ?>][]" value="<?php echo $skill[0] ?>" />
                            <a class="skill-url-del dashicons dashicons-no-alt"></a>
                        </td>
                        <td class="name"><input type="text" size="15" name="iz-ch-skills[<?= $i ?>][]" value="<?php echo $skill[1] ?>" /></td>
                        <td class="mana"><input type="number" size="5" name="iz-ch-skills[<?= $i ?>][]" value="<?php echo $skill[2] ?>" /></td>
                        <td class="down"><input type="number" size="5" name="iz-ch-skills[<?= $i ?>][]" value="<?php echo $skill[3] ?>" /></td>
                        <td class="desc"><textarea name="iz-ch-skills[<?= $i ?>][]"><?php echo $skill[4] ?></textarea></td>
                        <td class="skill-del"><a href="#" class="button"><span class="dashicons dashicons-no-alt" style="padding-top: 3px;"></span></a></td>
                    </tr>
                    <?php
                    $i++;
                }
            }
            ?>
        </table>
        <button id="add-skill" class="button" type="button"><?php echo __('Thêm kỹ năng', 'iz_theme') ?></button>
        <input type="hidden" name="iz-champion-skill-vl" value="1" />
    </div>
    <?php
}

function fl_champion_gallery($post) {
    $galleries = get_post_meta($post->ID, 'iz-ch-galleries', true);
    $galleries = ($galleries == null) ? null : $galleries;
    ?>
    <div id="champion-gallery">
        <ul class="champion-images ui-sortable">
            <?php
            if ($galleries != null) {
                foreach ($galleries as $item) {
                    ?>
                    <li class="image" data-attachment_id="" style="cursor: default;">
                        <img class="attachment-thumbnail iz-ch-image" width="150" height="150" alt="Gallery" src="<?php echo $item ?>" />
                        <input type="hidden" class="iz-ch-imgurl" name="iz-ch-galleries[]" value="<?php echo $item ?>" />
                        <a class="iz-actions-del dashicons dashicons-no-alt"></a>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>        
    </div>
    <p class="add_champion_images hide-if-no-js">
        <a data-text="Xóa" data-delete="Xóa ảnh" data-update="Thêm vào thư viện" data-chose="Thêm ảnh vào thư viện" href="#">Thêm ảnh Tướng</a>
    </p>
    <?php
}

function fl_champion_skin($post) {
    $ch_skins = get_post_meta($post->ID, 'iz-ch-skins', true);
    $ch_skins = ($ch_skins == null) ? null : $ch_skins;
    ?>
    <div id="champion-skins">
        <table class="iz-setting-box" style="width: 100%">
            <tr>
                <th></th>
                <th><?php echo __('Hình ảnh', 'iz_theme') ?></th>
                <th><?php echo __('Tên ngoại trang', 'iz_theme') ?></th>
                <th><?php echo __('Link video, ...', 'iz_theme') ?></th>
            </tr>
            <?php
            if ($ch_skins != null) {
                $i = 0;
                ?>
                <?php foreach ($ch_skins as $skill) { ?>
                    <tr class="iskin">
                        <th><span class="dashicons dashicons-arrow-right-alt2"></span></th>
                        <td class="icon">
                            <a class="icon-image" href="#"><img height="80" width="80" src="<?php echo $skill[0] ?>" /></a>
                            <input type="hidden" class="iz-ch-skin-url" name="iz-ch-skins[<?= $i ?>][]" value="<?php echo $skill[0] ?>" />
                            <a class="skin-url-del dashicons dashicons-no-alt"></a>
                        </td>
                        <td class="desc"><textarea name="iz-ch-skins[<?= $i ?>][]"><?php echo $skill[1] ?></textarea></td>
                        <td class="link"><textarea name="iz-ch-skins[<?= $i ?>][]"><?php echo $skill[2] ?></textarea></td>
                        <td class="skin-del"><a href="#" class="button"><span class="dashicons dashicons-no-alt" style="padding-top: 3px;"></span></a></td>
                    </tr>
                    <?php
                    $i++;
                }
            }
            ?>
        </table>
        <button id="add-skin" class="button" type="button"><?php echo __('Thêm Ngoại trang', 'iz_theme') ?></button>
    </div>

    <?php
}

function fl_load_champion_admin_script() {
    if (isset($_GET['post'])) {
        
    }
    wp_register_script('champion_gallery', get_template_directory_uri() . '/js/admin/champion.js', false, '1.0');
    wp_localize_script('champion_gallery', 'ajaxParams', array('ajaxurl' => admin_url('admin-ajax.php')));
    wp_enqueue_script('champion_gallery');

    wp_register_style('fl_admin_theme', get_template_directory_uri() . '/css/admin/admin_theme.css', false, '1.0');
    wp_enqueue_style('fl_admin_theme');
}

add_action('admin_enqueue_scripts', 'fl_load_champion_admin_script');

//ajax
add_action('wp_ajax_iz_load_level', 'iz_load_cham_level');
add_action('wp_ajax_iz_save_level', 'iz_save_cham_level');

function iz_load_cham_level() {
    $level = $_POST['level'];
    $post_id = $_POST['post_id'];
    $indexs = get_post_meta($post_id, 'iz-ch-indexs', true);
    $indexs = ($indexs == null) ? null : $indexs;

    if ($indexs != null) {
        ?>
        <table class="champion-ind-table level-<?= $level ?>">
            <?php
            if ($indexs[$level] != null) {
                foreach ($indexs[$level] as $key => $value) {
                    ?>
                    <tr class="index">
                        <th class="icon">
                            <input type="text" class="name" name="iz-ch-indexs[1][<?= $key ?>][]" value="<?php echo $value[0] ?>"
                        </th>
                        <td class="value">
                            <input type="text" class="value" name="iz-ch-indexs[1][<?= $key ?>][]" value="<?php echo $value[1] ?>" size="60" />
                        </td>
                        <td><a class="button index-del" href="#"><span class="dashicons dashicons-no-alt" style="padding-top: 3px;"></span></a></td>
                    </tr>
                    <?php
                }
            } else {
                ?>           
            <?php }
            ?>
        </table>
        <button class="add_index button">Thêm chỉ số</button>
        <?php
    }
    die();
}

function iz_save_cham_level() {
    $post_id = $_POST['post_id'];
    $level = $_POST['level'];

    $indexs = get_post_meta($post_id, 'iz-ch-indexs', true);
    $indexs = ($indexs == null) ? null : $indexs;
}

function fl_champion_save($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    // Check the user's permissions.
    if (isset($_POST['post_type']) && 'fl_champion' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return;
        }
    } else {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }
    // Make sure that it is set.
    if (isset($_POST['iz-ch-indexs'])) {
        update_post_meta($post_id, 'iz-ch-indexs', $_POST['iz-ch-indexs']);
    }
    if (isset($_POST['iz-ch-skills'])) {
        update_post_meta($post_id, 'iz-ch-skills', $_POST['iz-ch-skills']);
    }
    if (isset($_POST['iz-ch-galleries'])) {
        update_post_meta($post_id, 'iz-ch-galleries', $_POST['iz-ch-galleries']);
    }
    if (isset($_POST['iz-ch-skins'])) {
        update_post_meta($post_id, 'iz-ch-skins', $_POST['iz-ch-skins']);
    }
}

add_action('save_post', 'fl_champion_save');


//show in column
add_filter('manage_fl_champion_posts_columns', 'iz_show_champion_image_column', 10, 2);

function iz_show_champion_image_column($column) {
    $newcol = array_merge(array('fl_champion_image' => __('Hình ảnh', 'iz_champion')), $column);

    return $newcol;
}

function iz_get_champion_img($post_id) {
    $iz_img_id = get_post_thumbnail_id($post_id);
    if ($iz_img_id) {
        $chimg = wp_get_attachment_image_src($iz_img_id);
        return $chimg[0];
    }
}

add_action('manage_fl_champion_posts_custom_column', 'iz_champion_image_content', 10, 2);

function iz_champion_image_content($colname, $post_id) {
    if ($colname == 'fl_champion_image') {
        $cham_img = iz_get_champion_img($post_id);
        if ($cham_img) {
            echo '<img src="' . $cham_img . '" width="80" height="80" />';
        } else {
            echo 'None';
        }
    }
}

// register scripts frontend
//add_action('wp_enqueue_scripts', 'iz_register_custom_scripts');
//function iz_register_custom_scripts(){
//    wp_register_scripts('iz_guide', get_template_directory_uri().'/js/iz_guide.js', null, '1.0');
//    wp_enqueue('iz_guide');
//}
// meta box for guide
add_action('add_meta_boxes', 'fl_guide_meta_box');

function fl_guide_meta_box() {
    add_meta_box('fl-guide-champion', __('Tướng', 'iz_theme'), 'fl_guide_champion', 'fl_guide', 'normal', 'high', array());
}

function fl_guide_champion($post) {
    $champions = get_posts(array(
        'post_type' => 'fl_champion',
        'hide_empty' => false,
    ));
    ?>
    <select name="guide-champion" id="guide-champion">
        <option value="0">Chọn tướng</option>
    <?php foreach ($champions as $ch) { ?>
            <option value="<?php echo $ch->ID ?>"><?php echo $ch->post_title ?></option>
    <?php } ?>
    </select>
    <div class="list-champions">
        <?php $guide_ch = get_post_meta($post->ID, 'iz-guide-champion', true); ?>
        <?php foreach ($champions as $ch) { ?>
            <?php
            $ch_select = '';
            if ($ch->ID == $guide_ch) {
                $ch_select = 'ch-select';
            }
            ?>
            <div class="iz-champion <?php echo $ch_select ?>">
                <a href="#" data-id="<?php echo $ch->ID ?>" title="<?php echo $ch->post_title ?>">
            <?php echo get_the_post_thumbnail($ch->ID, 'ch-guide'); ?>
                </a>
            </div>
                <?php } ?>
    </div>
    <?php
}

function fl_guide_save($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    // Check the user's permissions.
    if (isset($_POST['post_type']) && 'fl_guide' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return;
        }
    } else {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }
    // Make sure that it is set.
    if (isset($_POST['guide-champion'])) {
        update_post_meta($post_id, 'iz-guide-champion', $_POST['guide-champion']);
    }
}

add_action('save_post', 'fl_guide_save');
