<?php

/* 
 * Template Name: Create Guide
 */

?>

<?php get_header(); ?>
<!--#blocks-wrapper-->
<div id="blocks-wrapper" class="clearfix">

    <div id="game-guide">        
        <?php ?>       
        <div class="post-content">
            <h1 class="entry-title"><?php the_title(); ?></h1>
            
            <div class="entry-content">
                <div class="meta_author">
                    
                </div>
                
                <div class="posted-status">
                    <p>
                    <?php
                    if(isset($_GET['posted'])){
                        if($_GET['posted'] == 'failed'){
                            echo __('<span class="error">Có lỗi xảy ra! Có thể bạn chưa chọn Tướng hoặc Thể loại', 'iz_theme</span>');
                        }else{
                            echo __('<span class="success">Bài viết của bạn đã được đăng thành công</span>');
                        }
                    }
                    ?>
                    </p>
                </div>
                
                <div class="guide-form">
                    <form method="post" action="" class="new-guide-form">
                        <div class="title">
                            <label><?= __('Tiêu đề', 'iz_theme'); ?></label>
                            <input type="text" class="guide-title" name="guide-title" required="" />
                        </div>
                        
                        <div class="box-select">
                            <?php $champions = get_posts(array(
                                'post_type' => 'fl_champion',
                                'hide_empty' => false
                            )); ?>
                            
                            <label><?= __('Chọn tướng', 'iz_theme'); ?></label>
                            <select name="guide-champion" id="guide-champion" required="">
                                <option value="0">Chọn tướng</option>
                                <?php foreach ($champions as $ch){ ?>
                                <option value="<?php echo $ch->ID ?>"><?php echo $ch->post_title ?></option>
                                <?php } ?>
                            </select>
                            
                            <div class="list-champions">
                                <?php foreach ($champions as $ch){ ?>
                                <div class="iz-champion">
                                    <a href="#" data-id="<?php echo $ch->ID ?>" title="<?php echo $ch->post_title ?>">
                                        <?php echo get_the_post_thumbnail($ch->ID, 'ch-guide') ?>
                                    </a>
                                </div>
                                <?php } ?>
                            </div>
                            
                            <div class="list-guide-cat" style="margin-top: 42px;">
                                <?php 
                                $guide_cats = get_terms('fl_guide_cat', array('hide_empty'=>false)); 
                                ?>
                                <label>Chọn thể loại</label>
                                <select id="guide-cat" name="guide-cat">
                                    <option value="0">Chọn thể loại</option>
                                    <?php foreach ($guide_cats as $cat){ ?>
                                    <option value="<?php echo $cat->term_id ?>"><?php echo $cat->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="guide-content">
                            <label><?= __('Nội dung', 'iz_theme'); ?></label>
                            <?php wp_editor('', 'guide-content', array('textarea_rows'=>13)); ?>
                        </div>
                        
                        <div class="guide-submit">
                            <?php //wp_nonce_field('add_guide'); ?>
                            <!--<input type="hidden" name="current-url" value="<?php //echo $_SERVER['REQUEST_URI']; ?>" />-->
                            <input type="hidden" name="current-url" value="<?php the_permalink() ?>" />
                            <input type="submit" name="submit-new-guide" value="<?= __('Tạo Guide', 'iz_theme') ?>" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>
 
 <?php get_footer(); ?>


