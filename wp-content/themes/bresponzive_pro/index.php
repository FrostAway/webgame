<?php get_header(); ?>
<!--#blocks-wrapper-->
<div id="blocks-wrapper" class="clearfix row">
<!--#blocks-left-or-right-->
<div class="col-sm-12 col-md-8 left-col">
	<div id="blocks-left" class="eleven columns clearfix">	
 	
			<?php
				$hb_layout = $data['homepage_blocks_content']['enabled'];

				if ($hb_layout):

				foreach ($hb_layout as $key=>$value) {

					switch($key) {
					 case 'hb_big_slider':
					 
					  if($data['offline_feat_slide'] != "0") { include_once('includes/flex-slider.php'); }
 
				     break;
 					 case 'hb_nor_blog':
					?>
 					 <h2 class="blogpost-wrapper-title"><?php echo __('Nổi bật', 'iz_theme'); ?></h2>	
							<?php include_once('includes/blog_loop.php');?>
							
							<?php
					 break;
					 case 'hb_mag_1':
					  if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Magazine Style Widgets)')) 
						break;	
					}

				}

				endif;						
						?>
   	</div>
</div>
 	<!-- /blocks col -->
 <?php get_sidebar();  ?>
 <?php get_footer(); ?>