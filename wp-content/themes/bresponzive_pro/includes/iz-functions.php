<?php
add_action('after_setup_theme', 'fl_image_size');

function fl_image_size() {
    add_image_size('talent-page', 550, 550, true);
    add_image_size('pager', 150, 150, true);
    add_image_size('media', 400, 400, true);
    add_image_size('show-media', 700, 400, true);
}

add_filter('post_thumbnail_html', 'iz_default_post_thumbnail');

function iz_default_post_thumbnail($html) {
    if (empty($html)) {
        $html = '<img class="thumbnail" src="' . get_template_directory_uri() . '/images/none_image.png"  alt="default" />';
    }
    return $html;
}

if (isset($_POST['iz-custom-login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $current_url = $_POST['iz-current-url'];

    if (!wp_login($username, $password)) {
        wp_redirect($current_url . '/?login=failed');
        die();
    } else {
        wp_signon(array('user_login' => $username, 'user_password' => $password));
        wp_redirect($current_url . '/?login=success');
        die();
    }
}

add_action('wp_enqueue_scripts', 'iz_register_scripts');

function iz_register_scripts() {
    wp_register_style('iz_fontawesome', get_template_directory_uri() . '/css/font-awesome/css/font-awesome.min.css', null, '4.3');
    wp_enqueue_style('iz_fontawesome');

    wp_register_style('iz_bootstrap', get_template_directory_uri() . '/dist/css/bootstrap.min.css', null, '1.0');
    wp_enqueue_style('iz_bootstrap');

    wp_register_script('iz_scripts', get_template_directory_uri() . '/js/iz_scripts.js', null, '1.0');
    wp_localize_script('iz_scripts', 'params', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'talent_url' => get_page_link(1103)
    ));
    wp_enqueue_media();
    wp_enqueue_script('iz_scripts');

    wp_register_script('iz_jquery_ui', get_template_directory_uri() . '/js/jquery-ui.min.js', null, '1.11.4');
    wp_enqueue_script('iz_jquery_ui');

    wp_register_style('jz_jquery_slider', get_template_directory_uri() . '/css/jquery-ui.min.css');
    wp_enqueue_style('jz_jquery_slider');

//    wp_register_script('iz_mediaelement', get_template_directory_uri().'/js/plugin/mediaelement/build/mediaelement-and-player.min.js');
//    wp_register_style('iz_mediaelement_css', get_template_directory_uri().'/js/plugin/mediaelement/mediaelementplayer.css');
//    wp_enqueue_script('iz_mediaelement');
//    wp_enqueue_style('iz_mediaelement_css');
    
    
    wp_register_script('iz_jquery_bxslider', get_template_directory_uri() . '/js/plugin/jquery.bxslider/jquery.bxslider.min.js');
    wp_enqueue_script('iz_jquery_bxslider');
    wp_register_style('iz_css_bxslider', get_template_directory_uri() . '/js/plugin/jquery.bxslider/jquery.bxslider.css');
    wp_enqueue_style('iz_css_bxslider');

    wp_register_script('iz_bootstrap_gallery', get_template_directory_uri() . '/js/plugin/bootstrap_gallery/css/bootstrap-image-gallery.min.css');
    wp_enqueue_script('iz_bootstrap_gallery');
    
     wp_register_style('fl_custom_theme', get_template_directory_uri().'/css/mycustom.css');
    wp_enqueue_style('fl_custom_theme');
    
}

add_action('wp_footer', 'iz_script_footer');

function iz_script_footer() {
//    wp_register_script('iz_bstrap_gallery', get_template_directory_uri() . '/js/plugin/bootrap_gallery/js/bootstrap-image-gallery.min.js');
//    wp_enqueue_script('iz_bstrap_gallery');
    
    wp_register_script('iz_bootstrap_js', get_template_directory_uri().'/dist/js/bootstrap.min.js');
    wp_enqueue_script('iz_bootstrap_js');
    
}

add_action('admin_enqueue_scripts', 'iz_admin_register_scripts');

function iz_admin_register_scripts() {
    wp_register_script('iz_admin_scripts', get_template_directory_uri() . '/js/admin/iz_admin_scripts.js', null, '1.0');
    wp_localize_script('iz_admin_scripts', 'params', array('ajaxurl' => admin_url('admin-ajax.php')));
    wp_enqueue_script('iz_admin_scripts');
}

if (isset($_POST['submit-new-guide'])) {
    $title = $_POST['guide-title'];
    $guid_ch = $_POST['guide-champion'];
    $guid_content = $_POST['guide-content'];
    $guid_cat = $_POST['guide-cat'];
    $thumbanil = $_POST['guide-thumbnail'];

    $current_url = $_POST['current-url'];
    
    if (strpos($current_url, '?')) {
        $redirect_fail = $current_url . '&posted=failed';
        $redirect_sc = $current_url . '&posted=success';
    } else {
        $redirect_fail = $current_url . '/?posted=failed';
        $redirect_sc = $current_url . '/?posted=success';
    }
    if ($guid_ch == 0 || $guid_cat == null) {
        wp_redirect($redirect_fail);
        die();
    } else {
        $post_id = wp_insert_post(array(
            'post_title' => wp_strip_all_tags($title),
            'post_content' => $guid_content,
            'post_type' => 'fl_guide',
            'post_status' => 'publish',
            'post_author' => get_current_user_id()
        ));

        $upload_dir = wp_upload_dir();
        $image_data = file_get_contents($thumbanil);
        $filename = basename($thumbanil);

        if (wp_mkdir_p($upload_dir['path'])) {
            $file = $upload_dir['path'] . '/' . $filename;
        } else {
            $file = $upload_dir['basedir'] . '/' . $filename;
        }

        // Create the image  file on the server
        file_put_contents($file, $image_data);

        // Check image file type
        $wp_filetype = wp_check_filetype($filename, null);

        // Set attachment data
        $attachment = array(

            'post_mime_type' => $wp_filetype['type'],
            'post_title' => sanitize_file_name($filename),
            'post_content' => '',
            'post_status' => 'inherit'
        );

        add_post_meta($post_id, 'iz-guide-champion', $guid_ch);
        $attach_id = wp_insert_attachment($attachment, $file, $post_id);
        require_once (ABSPATH . 'wp-admin/includes/image.php');
        $attach_data = wp_generate_attachment_metadata($attach_id, $file);
        wp_update_attachment_metadata($attach_id, $attach_data);
        set_post_thumbnail($post_id, $attach_id);
        
        wp_set_object_terms($post_id, $guid_cat, 'fl_guide_cat', true);

        wp_redirect($redirect_sc);
        die();
    }
}

// post thumbnail

function iz_thumbnail($post_id, $size) {
    if (has_post_thumbnail($post_id)) {
        ?>
        <a href="<?php echo get_permalink($post_id); ?>" title="<?php echo get_the_title($post_id); ?>" class="post-thumbnail">

            <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $size); ?>
            <img src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title($post_id); ?>"  />

        </a>
    <?php } else { ?>
        <a href="<?php echo get_permalink($post_id); ?>" rel="bookmark" title="<?php echo get_the_title($post_id); ?>"><img   src="<?php echo get_template_directory_uri(); ?>/images/default-image.png" width="60" height="60" alt="<?php echo get_the_title($post_id); ?>" /></a>
        <?php
    }
}

function the_short_desc($limit) {
    if (get_excerpt != '') {
        echo wp_trim_words(get_the_excerpt(), $limit, '......');
    } else {
        echo wp_trim_words(get_the_content(), $limit, '......');
    }
}

function get_short_desc($post_id, $limit) {
    $post = get_post($post_id);
    if ($post->post_excerpt != '') {
        return wp_trim_words($post->post_excerpt, $limit, '......');
    } else {
        return wp_trim_words($post->post_content, $limit, '......');
    }
}

function iz_galleries($post_id) {
    $main_url = wp_get_attachment_url(get_post_thumbnail_id($post_id));
    $gallery_ids = get_post_meta($post_id, 'iz-ch-galleries', true);
    $gallery_ids = ($gallery_ids == null) ? null : $gallery_ids;
    if ($gallery_ids == null) {
        return;
    } else {
        $galleries = array_merge(array($main_url), $gallery_ids);
        ?>
        <div class="ch-galleries">
        <?php foreach ($galleries as $image) { ?>
                <a class="slide" href="<?php echo $image ?>">
                    <img src="<?php echo $image ?>" />
                </a>
        <?php } ?>
        </div>
        <?php
    }
}

add_action('pre_get_posts', 'iz_post_query_function');

function iz_post_query_function($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (is_tax('fl_media_cat')) {
            $query->set('post_status', 'inherit');
        }
        if (is_tax('fl_guide_cat')) {
            $query->set('posts_per_page', 10);
        }
        if (is_category()) {
            $query->set('posts_per_page', 10);
        }
    }
}


//custom login logo
function iz_login_logo(){
    echo '<style type="text/css">'.
    '.login h1 a{background-image: url('.  get_template_directory_uri().'/images/iz_images/logo.png); background-size: 100%; width: 190px; height: 130px;}'
    . '</style>';
}
add_action('login_head', 'iz_login_logo');


//ajax admin
add_action('wp_ajax_load_champ_skill', 'iz_load_champ_skill');
add_action('wp_ajax_nopriv_load_champ_skill', 'iz_load_champ_skill');
function iz_load_champ_skill(){
    if(isset($_POST['ch_id'])){
        $ch_id = $_POST['ch_id'];
        $ch_skills = get_post_meta($ch_id, 'iz-ch-skills', true);
        $ch_skills = ($ch_skills == null) ? null : $ch_skills;
        if($ch_skills != null){
            foreach ($ch_skills as $key => $value){ ?>
        <div><label><input type="radio" name="talent-skill" value="<?php echo $key ?>" /> <?php echo $value[1] ?></label></div>
            <?php }
        }
    }
    die();
}

function get_max_index(){
    $champions = get_posts(array('post_type'=>'fl_champion'));
    $index_max = array();
    
    $ch_terms = get_terms('fl_champion_index', array('hide_empty'=>false));
    foreach ($ch_terms as $term){
        $index_max[$term->term_id] = 0;
    }
    
    foreach ($champions as $ch){
        $ch_indexs = get_post_meta($ch->ID, 'iz-ch-indexs', true);
        $ch_indexs = ($ch_indexs == null) ? null : $ch_indexs;
        if($ch_indexs != null){
            foreach ($ch_indexs as $key => $value){
                if($value[0] > $index_max[$key]){
                    $index_max[$key] = $value[0];
                }
            }
        }
    }
    return $index_max;
}

?>