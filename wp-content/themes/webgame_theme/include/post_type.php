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
        'menu_icon' => 'dashicons-images-alt2',
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
        'rewirte' => array('slug' => 'fl_champion_cat'),
        'query_var' => true
    ));
}

add_action('init', 'fl_add_post_type');

add_action('add_meta_boxes', 'fl_add_champion_fields');

function fl_add_champion_fields() {
    add_meta_box('fl-champion-info', 'Thông tin tướng', 'fl_champion_info', 'fl_champion', 'normal', 'high', array());
    add_meta_box('fl-champion-skill', 'Kỹ năng', 'fl_champion_skill', 'fl_champion', 'normal', 'high', array());
    add_meta_box('fl-champion-gallery', 'Hình ảnh tướng', 'fl_champion_gallery', 'fl_champion', 'side', 'low', array());
}

$champion_fields = array(
    array()
);

function fl_champion_info($post) {
    
}

function fl_champion_skill($post) {
    
}

function fl_champion_gallery($post) {
    $gallerys = get_post_meta($post->ID, 'fl-champion-gallerys', true);
    $gallerys = ($gallerys == null) ? null : $gallerys;
    ?>
    <div id="champion-gallery">
        <ul class="champion-images ui-sortable">
            <?php
            if ($gallerys != null) {
                foreach ($gallerys as $glr) {
                    ?>
                    <li class="image" data-attachment_id="" style="cursor: default;">
                        <img class="attachment-thumbnail" width="150" height="150" alt="Gallery" src="<?= $glr ?>" />
                        <div class="actions">
                            <a class="delete tips" href="#">Xóa</a>
                        </div>
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
function fl_load_champion_admin_script(){
    if(isset($_GET['post'])){}
    wp_register_script('champion_gallery', get_template_directory_uri().'/js/admin/champion_gallery.js', false, '1.0');
    wp_enqueue_script('champion_gallery');
    
    wp_register_style('fl_admin_theme', get_template_directory_uri().'/css/admin/admin_theme.css', false, '1.0');
    wp_enqueue_style('fl_admin_theme');
}
add_action('admin_enqueue_scripts', 'fl_load_champion_admin_script');
