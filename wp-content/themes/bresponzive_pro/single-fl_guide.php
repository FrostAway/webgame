<?php get_header(); ?>
<!-- #blocks-wrapper-->
<div id="blocks-wrapper" class="row clearfix">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?> 
    <div class="col-sm-12 col-md-8">
            <!-- /blocks Left -or -right -->
            <div id="blocks-left" <?php post_class('eleven columns'); ?>>	 		

                <!-- .post-content-->
                <div class="post-content">

                    <?php
                    if ($data['posts_bread'] == 'On') {
                        bresponZive_themepacific_breadcrumb();
                    }
                    ?>		
                    <?php
                    if ($data['featured_image'] == 'On') {
                        if (has_post_thumbnail()) {
                            ?>
                            <figure class="feat-thumb">
                                <?php
                                $singleImage = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                                $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'feat-image');
                                ?>
                                <a rel="prettyPhoto" class="opac" href='<?php echo $singleImage[0]; ?>' title="<?php the_title(); ?>">
                                    <img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>"   /></a>
                            </figure>
                            <!--/.feat-thumb-->
                            <?php
                        }
                    }
                    ?>			 
                    <!--/.post-outer -->
                    <div class="post-outer clearfix">

                        <!--.post-title-->
                        <div class="post-title"><h1 class="entry-title"><?php the_title(); ?></h1></div>
                        <!--/.post-title-->
                        <!--/#post-meta --> 
                        <div class="post-meta-blog">
                            <span class="meta_author vcard author"><span class="fn"><?php _e('Đăng bởi: ', 'iz_theme'); ?> <?php the_author_posts_link(); ?></span></span>
                            <span class="meta_date updated"><?php _e('Lúc: ', 'iz_theme'); ?> <?php the_time('F d, Y'); ?></span>
                            <span class="meta_comments">  <a href="<?php comments_link(); ?>"><?php comments_number('0 ', '1 ', '% '); ?> <span class="fa fa-comments"></span></a></span>
                            <?php edit_post_link(__('Sửa', 'iz_theme'), '<span class="edit-link">', '</span>'); ?>
                        </div>
                        
                        
                        <!--my custom-->
                        <div class="row guide-post-meta">
                            <div class="col-sm-6 champion">
                                <?php
                                $cham_id = get_post_meta(get_the_ID(), 'iz-guide-champion', true);
                                if($cham_id != 0){
                                $champion = get_post($cham_id);
                                ?>
                                <div class="image">
                                    <a href="<?php echo get_permalink($cham_id); ?>"><?php echo get_the_post_thumbnail($champion->ID, 'pager'); ?></a>
                                </div>
                                <div class="title">
                                    <a href="<?php echo get_permalink($cham_id); ?>"><span><?php echo $champion->post_title ?></span></a>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="col-sm-6">
                            <div class="list-tax">
                                <h3><?= __('Danh mục: ', 'iz_theme') ?></h3>
                                <ul class="taxs">
                                <?php echo get_the_term_list(get_the_ID(), 'fl_guide_cat', '<li>', ',</li><li>', '</li>'); ?>
                                </ul>
                            </div>
                            <div class="votes" id="iz-votes">
                                <div class="number">
                                    <?php $vote = get_post_meta(get_the_ID(),'iz-vote-post', true);
                                    if($vote == '') echo '0'; else echo $vote; ?> Votes
                                </div>
                                <a href="#" class="btn btn-success btn-vote-up" data-ip="<?php echo $_SERVER['REMOTE_ADDR'] ?>" data-id="<?php  echo get_the_ID() ?>"><span class="fa fa-thumbs-o-up"></span></a>
                                <a href="#" class="btn btn-danger btn-vote-down" data-ip="<?php echo $_SERVER['REMOTE_ADDR'] ?>" data-id="<?php  echo get_the_ID() ?>"><span class="fa fa-thumbs-o-down"></span></a>                                
                            </div>
                            </div>
                        </div>
                        
                        
                        <!--/#post-meta --> 
                        <?php if ($data['ptitle_below_ad_img']) { ?>
                            <a href="<?php echo $data['ptitle_below_ad_code']; ?>">
                                <img src="<?php echo $data['ptitle_below_ad_img']; ?>" border="0"></a>
                        <?php } else { ?>
                            <?php echo $data['ptitle_below_ad_code']; ?>
                        <?php } ?>
                        <!-- .post_content -->
                        <div class = 'post_content entry-content'>
                            <?php the_content(); ?>
                            <div class="clear"></div>
                            <?php if ($data['pend_below_ad_img']) { ?>
                                <a href="<?php echo $data['pend_below_ad_code']; ?>">
                                    <img src="<?php echo $data['pend_below_ad_img']; ?>" border="0"></a>
                            <?php } else { ?>
                                <?php echo $data['pend_below_ad_code']; ?>
                            <?php } ?>
                        </div>	
                        <!-- /.post_content -->
                        <?php wp_link_pages(); ?>
                        <div class='clear'></div>

                    </div>
                    <!--/.post-outer -->
                    <?php if ($data['social_shares'] == 'enable') { ?>		
                        <div class="tpcrn-shr-post">
                            <span class="head"><?php _e('Chia sẻ', 'iz_theme'); ?> </span>
                            <ul>
                                <?php if ($data['share_tw'] == 'show') { ?>	
                                    <li><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" " data-lang="en">tweet</a> <script>!function (d, s, id) {
                                            var js, fjs = d.getElementsByTagName(s)[0];
                                            if (!d.getElementById(id)) {
                                                js = d.createElement(s);
                                                js.id = id;
                                                js.src = "//platform.twitter.com/widgets.js";
                                                fjs.parentNode.insertBefore(js, fjs);
                                            }
                                        }(document, "script", "twitter-wjs");</script></li>
                                <?php } if ($data['share_fblike'] == 'show') { ?> 

                                    <li><iframe src="http://www.facebook.com/plugins/like.php?href=<?php the_permalink(); ?>&amp;layout=button_count&amp;show_faces=false&amp;width=105&amp;action=like&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:105px; height:21px;" allowTransparency="true"></iframe></li>
                                <?php }if ($data['share_gp'] == 'show') { ?>
                                    <li><div class="g-plusone" data-size="medium" data-href="<?php the_permalink(); ?>"></div>
                                        <script type='text/javascript'>
                                            (function () {
                                                var po = document.createElement('script');
                                                po.type = 'text/javascript';
                                                po.async = true;
                                                po.src = 'https://apis.google.com/js/plusone.js';
                                                var s = document.getElementsByTagName('script')[0];
                                                s.parentNode.insertBefore(po, s);
                                            })();
                                        </script>
                                    </li>
                                <?php }if ($data['share_stumble'] == 'show') { ?>	
                                    <li><!-- Place this tag where you want the su badge to render -->
                                    <su:badge layout="1"></su:badge>

                                    <!-- Place this snippet wherever appropriate -->
                                    <script type="text/javascript">
                                        (function () {
                                            var li = document.createElement('script');
                                            li.type = 'text/javascript';
                                            li.async = true;
                                            li.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//platform.stumbleupon.com/1/widgets.js';
                                            var s = document.getElementsByTagName('script')[0];
                                            s.parentNode.insertBefore(li, s);
                                        })();
                                    </script>
                                    </li>
                                <?php }if ($data['share_pin'] == 'show') { ?>
                                    <li>
                                        <script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script>
                                        <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php
                                        $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'feat-image');
                                        echo $image[0];
                                        ?>"   data-pin-do="buttonPin" data-pin-config="beside">
                                            <img border="0" src="http://assets.pinterest.com/images/pidgets/pin_it_button.png" title="Pin It" />
                                        </a></li>
                                    <?php }if ($data['share_in'] == 'show') { ?>
                                    <li><script src="//platform.linkedin.com/in.js" type="text/javascript">lang: en_US</script><script type="IN/Share" data-counter="right"></script></li>
                                <?php } ?>

                            </ul>
                        </div> <!-- .share-post -->
                    <?php } ?>

                    <?php if ($data['posts_tags'] == 'On') { ?>
                        <p class="post-tags">
                            <strong><?php _e('TOPICS', 'iz_theme'); ?> </strong><?php the_tags('', ''); ?>					
                        </p>
                    <?php } ?>
                </div>
                <!-- post-content-->

                <?php if ($data['posts_navigation'] == 'On') { ?>
                    <!-- .single-navigation-->
                    <div class="single-navigation clearfix">
                        <div class="previous"><?php previous_post_link('%link', ' <span>  Trước:</span> %title'); ?></div>
                        <div class="next"><?php next_post_link('%link', ' <span>Sau:  </span> %title '); ?></div>

                    </div>
                    <!-- /single-navigation-->
                <?php } ?>
                <?php if ($data['shw_auth_box'] == 'yes') { ?>	
                    <div class="author-content">
                        <h3><?php _e('Giới thiệu về', 'iz_theme'); ?> <?php the_author_meta('nickname'); ?></h3>
                        <div id="tpcrn_author" class="author-gravatar-head">
                            <?php echo get_avatar(get_the_author_meta('email'), '60'); ?>

                            <div class="author_desc"><p><?php the_author_meta('description'); ?></p></div>

                            <ul class="singlep-author-share">
                                <li><a href="<?php echo home_url(); ?>/author/<?php the_author_meta('user_nicename'); ?>"><?php _e('Tác giả', 'iz_theme'); ?></a></li>

                                <?php if (get_the_author_meta('twitter')) { ?>
                                    <li>
                                        <a class="twitter" href='http://twitter.com/<?php echo get_the_author_meta('twitter'); ?>'>Twitter</a>
                                    </li><?php } ?>

                                <?php if (get_the_author_meta('googleplus')) { ?><li>
                                        <a class="gp" href='<?php echo get_the_author_meta('googleplus'); ?>'>Google+</a></li>
                                <?php } ?>
                                <div class="clear"/>
                            </ul>
                        </div>
                    </div>

                <?php } ?>

                <?php
                if ($data['posts_related'] == '1') {
                    include_once('includes/related.php');
                }
                ?>
                <?php comments_template(); ?>
                <?php
            endwhile;
        endif;
        ?>

    </div>
    <!-- /blocks Left-->
            </div>

    <?php get_sidebar(); ?>

    <?php get_footer(); ?>

