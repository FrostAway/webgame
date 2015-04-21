<?php
/*
 * Template Name: Quản lý
 */
get_header();
?>

<div id="blocks-wrapper" class="clearfix">
    <div id="post_manage">
        <div class="post-content">
            <h1 class="entry-title"><?php echo __('Thông tin cá nhân', 'iz_theme'); ?></h1>

            <?php echo do_shortcode('[wpuf_profile type="profile" id="1264"]'); ?>

            <h1 class="entry-title"><?php echo __('Quản lý bài đăng', 'iz_theme'); ?></h1>
            <?php echo do_shortcode('[wpuf_dashboard]'); ?>
            <?php echo do_shortcode('[wpuf_dashboard post_type="fl_guide"]'); ?>

        </div>

        <script>
            (function ($) {

                $(document).ready(function () {
                    $('.wpuf-author:first').remove();

//                    $('#load-comment').click(function(e){
//                       e.preventDefault();
//                       $('#load-content').load('https://graph.facebook.com/comments?id=http://phimvipvn.net/qua-nhanh-qua-nguy-hiem-7-fast-and-furious-7.2494/', function (data){
//                           alert('ok');
//                       });
//                   });

//                       $.ajax({
//                           type: 'POST',
//                           url: 'https://graph.facebook.com/comments?id=http://phimvipvn.net/qua-nhanh-qua-nguy-hiem-7-fast-and-furious-7.2494/',
//                           data: {
//                               access_token: '1395390994084918|dbRuDeJEX7NuCBLXWNFIoCxvzOo'
//                           },
//                           success: function(){
//                               
//                           }
//                       });
//                    });

                });


              
                
            })(jQuery);
        </script>

        <?php
        query_posts(array('post_type' => array('post', 'fl_guide'), 'showposts' => 10));
        if (have_posts()):while (have_posts()):the_post();
                $fql_query_result = file_get_contents("https://graph.facebook.com/fql?q=SELECT+fromid,+object_id+FROM+comment+WHERE+object_id+IN+(SELECT+comments_fbid+FROM+link_stat+WHERE+url='hots.com.vn/fl_guide/master-of-vision-a-tyrande-guide-2/')+ORDER+BY+time+DESC+limit+5");
                $data = json_decode($fql_query_result, true);
                print_r($data);
                foreach ($data[data] as $user) {
                    $id = sprintf("%.0f", $user[fromid]);
                    $profile = file_get_contents('http://graph.facebook.com/'.$id.'/');
                    $arrprofile = json_decode($profile);
                    print_r($arrprofile);
                }
            endwhile;
            wp_reset_query();
        endif;
        ?>



    </div>
</div>

<?php get_footer(); ?>

