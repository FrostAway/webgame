<?php
add_action('wp_ajax_champion_tooltip', 'iz_load_champion_tooltip');
add_action('wp_ajax_nopriv_champion_tooltip', 'iz_load_champion_tooltip');

function iz_load_champion_tooltip() {
    $post_id = $_POST['ch_id'];
    ?>

    <div class="title">
        <span><?php echo get_the_post_thumbnail($post_id, 'ch-guide'); ?></span>
        <span><h3><?php echo get_the_title($post_id); ?></h3></span>
    </div>
    <div class="excerpt">
        <?php echo get_short_desc($post_id, 30); ?>
    </div>
    <?php
    die();
}

add_action('wp_ajax_iz_like_post', 'iz_like_post');
add_action('wp_ajax_iz_dislike_post', 'iz_dislike_post');
add_action('wp_ajax_nopriv_iz_like_post', 'iz_like_post');
add_action('wp_ajax_nopriv_iz_dislike_post', 'iz_dislike_post');

function iz_like_post() {
    $post_id = $_POST['post_id'];
    $ip = $_POST['ip_addr'];

    $vote = get_post_meta($post_id, 'iz-vote-post', true);
    $user_votes = get_post_meta($post_id, 'iz-vote-users', true);
    $user_votes = ($user_votes == null) ? null : $user_votes;

    $result = array();

    if ($vote == '') {
        add_post_meta($post_id, 'iz-vote-post', 1);
        $user_votes = array($ip);
        add_post_meta($post_id, 'iz-vote-users', $user_votes);
        $result['stt'] = 1;
        $result['mess'] = __('Cám ơn bạn đã đánh giá!', 'iz_theme');
        $result['num'] = 1;
    } else {
        if ($vote != 0 && in_array($ip, $user_votes)) {
            $result['stt'] = 2;
            $result['mess'] = __('Bạn đã bình chọn rồi!', 'iz_theme');
            $result['num'] = $vote;
            
        } else {
            $result['stt'] = 3;
            $result['mess'] = __('Cám ơn bạn đã đánh giá!', 'iz_theme');
            $result['num'] = $vote + 1;
            $user_votes[] = $ip;
            update_post_meta($post_id, 'iz-vote-post', $vote+1);
            update_post_meta($post_id, 'iz-vote-users', $user_votes);
        }
    }
    echo json_encode($result);
    die();
}
function iz_dislike_post(){
    $post_id = $_POST['post_id'];
    $ip = $_POST['ip_addr'];

    $vote = get_post_meta($post_id, 'iz-vote-post', true);
    $user_votes = get_post_meta($post_id, 'iz-vote-users', true);
    $user_votes = ($user_votes == null) ? null : $user_votes;

    $result = array();

    if ($vote == '') {
        add_post_meta($post_id, 'iz-vote-post', 0);
        $user_votes = array($ip);
        add_post_meta($post_id, 'iz-vote-users', $user_votes);
        $result['stt'] = 1;
        $result['mess'] = __('Cám ơn bạn đã đánh giá!', 'iz_theme');
        $result['num'] = 0;
    } else {
        if ($vote !=0 && in_array($ip, $user_votes)) {
            $result['stt'] = 2;
            $result['mess'] = __('Cám ơn bạn!', 'iz_theme');
            $result['num'] = $vote-1;
            
            foreach ($user_votes as $key => $user){
                if($user == $ip){
                    unset($user_votes[$key]);
                    break;
                }
            }
            update_post_meta($post_id, 'iz-vote-post', $vote-1);
            update_post_meta($post_id, 'iz-vote-users', $user_votes);
        } else {
            $result['stt'] = 3;
            $result['mess'] = __('Cám ơn bạn đã đánh giá!', 'iz_theme');
            $result['num'] = $vote;
        }
    }
    echo json_encode($result);
    die();
}