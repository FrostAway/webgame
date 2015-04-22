<?php
add_action('wp_ajax_champion_tooltip', 'iz_load_champion_tooltip');
add_action('wp_ajax_nopriv_champion_tooltip', 'iz_load_champion_tooltip');

function iz_load_champion_tooltip() {
    $post_id = $_POST['ch_id'];
    ?>

    <div class="title">
        <span><?php echo get_the_post_thumbnail($post_id, 'sb-post-thumbnail'); ?></span>
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
            update_post_meta($post_id, 'iz-vote-post', $vote + 1);
            update_post_meta($post_id, 'iz-vote-users', $user_votes);
        }
    }
    echo json_encode($result);
    die();
}

function iz_dislike_post() {
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
        if ($vote != 0 && in_array($ip, $user_votes)) {
            $result['stt'] = 2;
            $result['mess'] = __('Cám ơn bạn!', 'iz_theme');
            $result['num'] = $vote - 1;

            foreach ($user_votes as $key => $user) {
                if ($user == $ip) {
                    unset($user_votes[$key]);
                    break;
                }
            }
            update_post_meta($post_id, 'iz-vote-post', $vote - 1);
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

//ajax admin
add_action('wp_ajax_load_champ_skill', 'iz_load_champ_skill');
add_action('wp_ajax_nopriv_load_champ_skill', 'iz_load_champ_skill');

function iz_load_champ_skill() {
    if (isset($_POST['ch_id'])) {
       $champion = $_POST['ch_id'];
            ?>
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
            <?php
      
    die();
    }
}
