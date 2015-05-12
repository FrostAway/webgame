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
    register_taxonomy('fl_talent_cat', 'fl_champion', array(
        'labels' => array(
            'name' => 'Talents',
            'singular_name' => 'Quản lý Talents',
            'add_new' => 'Thêm Talent',
            'new_item_name' => 'Talent mới',
            'add_new_item' => 'Thêm Talent'
        ),
        'public' => true,
        'hierarchical' => true,
        'show_admin_column' => false,
        'meta_box_cb' => false,
        'rewirte' => array('slug' => 'fl_talent_cat'),
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
        'hierarchical' => true,
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
            'title', 'thumbnail', 'editor', 'comments', 'excerpt', 'author'
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
        'has_archive' => true,
        'show_admin_column' => true,
        'rewirte' => array('slug' => 'fl_guide_cat'),
        'query_var' => true
    ));
}

add_action('init', 'fl_add_post_type');

add_action('add_meta_boxes', 'fl_add_champion_fields');

function fl_add_champion_fields() {

    add_meta_box('fl-champion-status', __('Champion Frames', 'iz_theme'), 'fl_champion_status', 'fl_champion', 'normal', 'high', array());
    add_meta_box('fl-champion-ind', __('Chỉ số tướng', 'iz_theme'), 'fl_champion_ind', 'fl_champion', 'normal', 'high', array());
    add_meta_box('fl-champion-skill', __('Kỹ năng', 'iz_theme'), 'fl_champion_skill', 'fl_champion', 'normal', 'high', array());
    
    add_meta_box('fl-champion-talent', __('Talents', 'iz_theme'), 'fl_champion_talent', 'fl_champion', 'normal', 'high', array());
    add_meta_box('fl-champion-skin', __('Ngoại Trang', 'iz_theme'), 'fl_champion_skin', 'fl_champion', 'normal', 'high', array());
    add_meta_box('fl-champion-gallery', __('Hình ảnh tướng', 'iz_theme'), 'fl_champion_gallery', 'fl_champion', 'side', 'low', array());
    add_meta_box('fl-champion-face', __('Ảnh mặt tướng', 'iz_theme'), 'fl_champion_face', 'fl_champion', 'side', 'low', array());
    add_meta_box('fl-champion-bg', __('Ảnh Nền', 'iz_theme'), 'fl_champion_bg', 'fl_champion', 'side', 'low', array());
}

function fl_champion_status($post){
    $ch_status = get_post_meta($post->ID, 'iz-ch-status', true);
    $ch_status = ($ch_status == null) ? null : $ch_status;
    ?>
    <div id="champion-status">
        <div class="list-status">
            <label><input type="radio" value="none" name="iz-ch-status" <?php checked('none', $ch_status, true) ?> > None</label>
            <label><input type="radio" value="free" name="iz-ch-status" <?php checked('free', $ch_status, true) ?> > Free</label>
            <label><input type="radio" value="sale" name="iz-ch-status" <?php checked('sale', $ch_status, true) ?> > Sale</label>
        </div>
    </div>
    <?php
}
function fl_champion_ind($post) {
    $ch_inds = get_post_meta($post->ID, 'iz-ch-indexs', true);
    $ch_inds = ($ch_inds == null) ? null : $ch_inds;
    ?>
    <div id="champion-ind">
        <table class="champion-ind-table">
            <?php
            $index_cats = get_the_terms($post->ID, 'fl_champion_index');
            ?>
            <tr>
                <th><?php echo __('Tên', 'iz_theme') ?></th>
                <th><?php echo __('Chỉ số', 'iz_theme') ?></th>
                <th><?php echo __('Cộng mỗi level', 'iz_theme') ?></th>
            </tr>
            <?php
            if($index_cats){
            foreach ($index_cats as $tax) {
                ?>
                <tr class="index">
                    <td><?= $tax->name ?></td>
                    <td><input type="text" name="iz-ch-indexs[<?= $tax->term_id ?>][]" value="<?php if ($ch_inds != null) echo $ch_inds[$tax->term_id][0] ?>" /></td>
                    <td><input type="text" name="iz-ch-indexs[<?= $tax->term_id ?>][]" value="<?php if ($ch_inds != null) echo $ch_inds[$tax->term_id][1] ?>" /></td>
                </tr>
                <?php
            }
            }
            ?>

        </table>
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
                <th><?php echo __('Hình ảnh', 'iz_theme') ?></th>
                <th><?php echo __('Tên', 'iz_theme') ?></th>
                <th><?php echo __('Dùng Mana', 'iz_theme') ?></th>
                <th><?php echo __('T/G Hồi', 'iz_theme') ?></th>
                <th><?php echo __('Video Link', 'iz_theme') ?></th>
                <th><?php echo __('Mô tả', 'iz_theme') ?></th>
                <th><?php echo __('Lần nạp', 'iz_theme') ?></th>
                <th><?php echo __('TG nạp', 'iz_theme') ?></th>
                <th><?php echo __('Mới', 'iz_theme') ?></th>
                
            </tr>
            <?php
            if ($ch_skills != null) {
                ?>
                <?php foreach ($ch_skills as $key => $skill) { ?>
                    <tr class="iskill">
                        <td class="icon" rowspan="2">
                            <a class="icon-image" href="#"><img height="45" width="45" src="<?php echo $skill[0] ?>" /></a>
                            <input type="hidden" class="iz-ch-skill-url" name="iz-ch-skills[<?= $key ?>][]" value="<?php echo $skill[0] ?>" />
                            <a class="skill-url-del dashicons dashicons-no-alt"></a>
                        </td>
                        <td class="name"><input type="text" required="" size="10" name="iz-ch-skills[<?= $key ?>][]" value="<?php echo $skill[1] ?>" /></td>
                        <td class="mana"><input type="text" size="5" name="iz-ch-skills[<?= $key ?>][]" value="<?php echo $skill[2] ?>" /></td>
                        <td class="down"><input type="text" size="5" name="iz-ch-skills[<?= $key ?>][]" value="<?php echo $skill[3] ?>" /></td>
                        
                        <td class="lv-plus" rowspan="2"><textarea name="iz-ch-skills[<?= $key ?>][]" placeholder="<iframe width=..."><?php echo $skill[4] ?></textarea></td>
                        <td class="desc" rowspan="2"><textarea name="iz-ch-skills[<?= $key ?>][]"><?php echo $skill[5] ?></textarea></td>
                        
                        <td class="chager"><input type="text" name="iz-ch-skills[<?= $key ?>][]" value="<?php echo $skill[6] ?>" /></td>
                        <td class="chager-col"><input type="text" name="iz-ch-skills[<?= $key ?>][]" value="<?php echo $skill[7] ?>" /></td>
                        
                        <td class="newskill"><input type="checkbox" name="iz-ch-skills[<?= $key ?>][]" value="1" <?php checked(1, $skill[8], true) ?> /></td>
                        
                        <td class="skill-del"><a href="#" class=""><?php echo __('Xóa', 'iz_theme') ?></a></td>                       
                    </tr>
                    <tr></tr>
                    <?php
                }
            }
            ?>
        </table>
        <button id="add-skill" class="button" type="button"><?php echo __('Thêm kỹ năng', 'iz_theme') ?></button>
        <input type="hidden" name="iz-champion-skill-vl" value="1" />
    </div>
    <?php
}


function fl_champion_talent($post){
    $all_terms = get_terms('fl_talent_cat', array('hide_empty'=>false));
    $terms = get_the_terms($post->ID, 'fl_talent_cat');
    ?>
<div id="champion-talent">
    <?php 
    foreach ($all_terms as $term){
        $check = '';
        if($terms)
        foreach ($terms as $tm){
            if($term->term_id == $tm->term_id){
                $check = 'checked';
                break;
            }
        }
    ?>
    <label style="display: inline-block; width: 49%;"><input <?php echo $check; ?> type="checkbox" name="tax_input[fl_talent_cat][]" value="<?php echo $term->term_id ?>" /> <?php echo $term->name ?> <a target="_blank" href="<?php echo get_edit_term_link($term->term_id, 'fl_talent_cat'); ?>"> <?php echo __('Sửa', 'iz_theme') ?></a></label>
    <?php
    }
    ?>
</div>
<?php
}

function fl_champion_skill_old($post) {
    $ch_skills = get_post_meta($post->ID, 'iz-ch-skills', true);
    $ch_skills = ($ch_skills == null) ? null : $ch_skills;
    
    ?>
    <div id="champion-skill">
        <table class="iz-setting-box" style="width: 100%">
            <tr>
                <th><?php echo __('Hình ảnh', 'iz_theme') ?></th>
                <th><?php echo __('Tên', 'iz_theme') ?></th>
                <th><?php echo __('Dùng Mana', 'iz_theme') ?></th>
                <th><?php echo __('T/G Hồi', 'iz_theme') ?></th>
                <th><?php echo __('Mô tả', 'iz_theme') ?></th>
                <th><?php echo __('Animate (Video)', 'iz_theme') ?></th>
            </tr>
            <?php
            if ($ch_skills != null) {
                ?>
        <?php foreach ($ch_skills as $key => $skill) { ?>
                    <tr class="iskill">
                        <td class="icon">
                            <a class="icon-image" href="#"><img height="45" width="45" src="<?php echo $skill[0] ?>" /></a>
                            <input type="hidden" class="iz-ch-skill-url" name="iz-ch-skills[<?= $key ?>][]" value="<?php echo $skill[0] ?>" />
                            <a class="skill-url-del dashicons dashicons-no-alt"></a>
                        </td>
                        <td class="name"><input type="text" size="15" name="iz-ch-skills[<?= $key ?>][]" value="<?php echo $skill[1] ?>" /></td>
                        <td class="mana"><input type="number" size="5" name="iz-ch-skills[<?= $key ?>][]" value="<?php echo $skill[2] ?>" /></td>
                        <td class="down"><input type="number" size="5" name="iz-ch-skills[<?= $key ?>][]" value="<?php echo $skill[3] ?>" /></td>
                        <td class="desc"><textarea name="iz-ch-skills[<?= $key ?>][]"><?php echo $skill[4] ?></textarea></td>
                        <td class="animate">
                            <a class="icon-image" href="#">
                                <!--<img height="70" width="70" src="<?php //echo $skill[5]  ?>" alt="Select" />-->
                                <video style="width: 100px;">
                                    <source src="<?php echo $skill[5] ?>" />
                                </video>
                            </a>
                            <input type="hidden" class="iz-ch-skill-url" name="iz-ch-skills[<?= $key ?>][]" value="<?php if ($skill[5]) echo $skill[5] ?>" />
                            <a class="skill-url-del dashicons dashicons-no-alt"></a> 
                        </td>
                        <td class="skill-del"><a href="#" class="button"><span class="dashicons dashicons-no-alt" style="padding-top: 3px;"></span></a></td>

                    </tr>
                    <?php
                }
            }
            ?>
        </table>
        <button id="add-skill" class="button" type="button"><?php echo __('Thêm kỹ năng', 'iz_theme') ?></button>
        <input type="hidden" name="iz-champion-skill-vl" value="1" />
    </div>
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

function fl_champion_face($post) {
    $face = get_post_meta($post->ID, 'iz-ch-face', true);
    ?>
    <div id="champion-face">
        <div id="champion-face-image">
            <img id="show-chapion-face" src="<?php if ($face != '') echo $face; ?>" alt="Champion face" />
            <a href="#" id="del-champion-face"><?php echo __('Xóa', 'iz_theme'); ?></a>
            <input type="hidden" name="iz-ch-face" id="champion-face-value" value="<?php echo $face ?>" />
        </div>
        <a href="<?php echo $face ?>" id="btn-champion-face"><?php echo __('Chọn ảnh', 'iz_theme') ?></a>
    </div>
    <?php
}

function fl_champion_bg($post) {
    $bg = get_post_meta($post->ID, 'iz-ch-bg', true);
    ?>
    <div id="champion-bg">
        <div id="show-bg">
            <img style="width: 100%;" id="show-bg-image" src="<?php echo $bg ?>" alt="<?php echo __('Chọn ảnh nền', 'iz_theme') ?>" />
            <a href="#" id="del-bg-image"><?php echo __('Xóa', 'iz_theme') ?></a>
            <input type="hidden" name="iz-ch-bg" id="champion-bg-value" value="<?php echo $bg ?>" />
        </div>
        <a href="<?php echo $bg ?>" id="btn-champion-bg"><?php echo __('Chọn ảnh nền', 'iz_theme') ?></a>
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
    if(isset($_POST['iz-ch-status'])){
        update_post_meta($post_id, 'iz-ch-status', $_POST['iz-ch-status']);
    }
    if (isset($_POST['iz-ch-indexs'])) {
        update_post_meta($post_id, 'iz-ch-indexs', $_POST['iz-ch-indexs']);
    }
    if (isset($_POST['iz-ch-skills'])) {
        update_post_meta($post_id, 'iz-ch-skills', $_POST['iz-ch-skills']);
    }
    if (isset($_POST['iz-ch-skins'])) {
        update_post_meta($post_id, 'iz-ch-skins', $_POST['iz-ch-skins']);
    }
    if (isset($_POST['iz-ch-galleries'])) {
        update_post_meta($post_id, 'iz-ch-galleries', $_POST['iz-ch-galleries']);
    }
    if (isset($_POST['iz-ch-face'])) {
        update_post_meta($post_id, 'iz-ch-face', $_POST['iz-ch-face']);
    }
    if (isset($_POST['iz-ch-bg'])) {
        update_post_meta($post_id, 'iz-ch-bg', $_POST['iz-ch-bg']);
    }
}

add_action('save_post', 'fl_champion_save');


//show in column
add_filter('manage_fl_champion_posts_columns', 'iz_show_champion_image_column', 10, 2);

function iz_show_champion_image_column($column) {
    $new_columns = array();
    $new_columns['cb'] = $column['cb'];
    $new_columns['fl_champion_image'] = __('Hình ảnh', 'iz_champion');
    unset($column['cb']);
    $newcol = array_merge($new_columns, $column);
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
    <?php $guide_ch = get_post_meta($post->ID, 'iz-guide-champion', true); ?>
    <select name="guide-champion" id="guide-champion">
        <option value="0">Chọn tướng</option>
        <?php foreach ($champions as $ch) { ?>
            <option value="<?php echo $ch->ID ?>" <?php selected($ch->ID, $guide_ch, true); ?>><?php echo $ch->post_title ?></option>
        <?php } ?>
    </select>
    <div class="list-champions">

        <?php foreach ($champions as $ch) { ?>
            <?php
            $ch_select = '';
            if ($ch->ID == $guide_ch) {
                $ch_select = 'ch-select';
            }
            ?>
            <div class="iz-champion <?php echo $ch_select ?>">
                <a href="#" data-id="<?php echo $ch->ID ?>" title="<?php echo $ch->post_title ?>">
                    <?php echo get_the_post_thumbnail($ch->ID, 'sb-post-thumbnail'); ?>
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
