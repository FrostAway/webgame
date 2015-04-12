<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>	
<!-- Meta info -->
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<!-- Title -->
<?php global $data;?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
 <?php if($data['custom_feedburner']) : ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php echo esc_url($data['custom_feedburner']); ?>" />
<?php endif; ?>
<?php if($data['custom_favicon']): ?>
<link rel="shortcut icon" href="<?php echo esc_url($data['custom_favicon']); ?>" /> <?php endif;  ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />




<!-- CSS + jQuery + JavaScript --> 
<link href='http://fonts.googleapis.com/css?family=Open+Sans:regular,bold' rel='stylesheet' type='text/css'/>
<!--[if lt IE 9]> 
<link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/css/ie8.css' type='text/css' media='all' />
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> 
<script type="text/javascript" src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
<!--[if  IE 9]>
<link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/css/ie9.css' type='text/css' media='all' /> 
<![endif]-->
<?php 	
if ( is_singular() && get_option( 'thread_comments' ) )		wp_enqueue_script( 'comment-reply' );  
	wp_head();
?>
<?php if($data['tptheme_skins']!='default'){ if (!empty($data['tptheme_skins'])) {?>
<link href="<?php echo get_template_directory_uri(); ?>/css/skins/<?php echo trim($data['tptheme_skins']); ?>.css" rel="stylesheet" media="all" type="text/css" /> 
<?php } } ?>

<!--font open sans-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,800,400italic,600italic,800italic' rel='stylesheet' type='text/css'>
</head>  

<body <?php body_class();?>> 
    
    
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.3&appId=1418616455105788";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- #wrapper -->	
<div id="wrapper" class="container clearfix" style="padding: 0"> 
   <?php 
     if ( has_nav_menu('topNav') ){ 
   ?>
	<!-- #CatNav -->  
        <div id="catnav" class="top-nav">	
		<?php //wp_nav_menu(array('theme_location' => 'topNav','container'=> '','menu_id'=> 'catmenu','menu_class'=> ' container clearfix','fallback_cb' => 'false','depth' => 3)); ?>
            <ul id="catmenu" class="container">
                <?php global $wp;
                        $current_url = home_url(add_query_arg(array(), $wp->request))
                        ?>
                <?php if(is_user_logged_in()){ ?>
                <li class="menu-item">
                    <a href="<?php echo wp_logout_url(home_url()) ?>"><?php echo __('Đăng xuất', 'iz_theme') ?></a>
                </li>
                <li class="menu-item">
                    <?php $user = wp_get_current_user(); ?>
                    <a href="#"><?php echo __('Xin chào: ', 'iz_theme') ?> <strong><?php echo $user->data->user_nicename ?></strong></a>
                </li>
                <li class="menu-item">
                    <a href="#" style="text-transform: none">
                        <?php
                        if(isset($_GET['login']) && $_GET['login'] == 'success'){
                                echo 'Đăng nhập thành công';
                            }
                        ?>
                    </a>
                </li>
                
                <?php }else{ ?>
                
                <li class="menu-item">
                    <a id="iz-register" href="#"><?php echo __('Đăng ký', 'iz_theme') ?></a>
                </li>
                
                <li class="menu-item">
                    <form class="login-form" method="post" action="">
                        <input type="text" class="username" name="username" placeholder="<?php echo __('Tên tài khoản', 'iz_theme'); ?>" required="" />
                        <input type="password" class="password" name="password" placeholder="<?php echo __('Mật khẩu', 'iz_theme'); ?>" required="" />
                        
                        <input type="hidden" name="iz-current-url" value="<?= $current_url ?>" />
                        <input type="submit" name="iz-custom-login" class="btn-submit" value="<?php echo __('Đăng nhập', 'iz_theme'); ?>" />
                    </form>
                </li>
                <li class="menu-item login-stt">
                    <a href="#" style="text-transform: none;">
                        <?php if(isset($_GET['login'])){
                            if($_GET['login'] == 'failed'){
                                echo 'Sai Tên hoặc Mật khẩu';
                            }
                        } ?>
                    </a>
                </li>
                <?php } ?>
            </ul>
	</div> 
	<!-- /#CatNav -->  
	<?php } ?> 
<!-- /#Header --> 
<div id="wrapper-container"> 

<div id="header">	
	<div id="head-content" class="clearfix ">
 	 
			<!-- Logo --> 
			<div id="logo">   
				<?php if($data['custom_logo'] !='') { 
				if($data['custom_logo']) {  $logo = $data['custom_logo']; 		
				} else { $logo = get_template_directory_uri() . '/images/logo.png'; 	
				} ?>  <a href="<?php echo esc_url( home_url( '/' ) );  ?>" title="<?php bloginfo( 'name' ); ?>" rel="home"><img src="<?php echo esc_url($logo); ?>" alt="<?php bloginfo( 'name' ) ?>" /></a>    
				<?php } else { ?>   
				<?php if (is_home()) { ?>     
				<h1><a href="<?php echo esc_url( home_url( '/' ) );  ?>" title="<?php bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1> <span><?php bloginfo( 'description' ); ?></span>
				<?php } else { ?>  
				<h2><a href="<?php echo esc_url( home_url( '/' ) );  ?>" title="<?php bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>  
				<?php } } ?>   
			</div>	 	
			<!-- /#Logo -->
 		
  					<!-- Header Ad -->
		<?php if($data['head_ban_ad_img']) { ?>	
		<div id="header-banner468" class="clearfix">
					<a href="<?php echo $data['head_ad_code']; ?>"> <img src="<?php echo $data['head_ban_ad_img']; ?>" alt=""></a> 
			</div>
		<?php } else { ?>			
		<div id="header-banner468">
				<?php echo $data['head_ad_code']; ?>
		</div>	
		<?php } ?>	
		<!-- /#Header Ad -->
	 	
 	</div>	
 </div>
<!-- /#Header --> 

   <?php 
     if ( has_nav_menu('mainNav') ){ 
   ?>
	<!-- #CatNav -->  
	<div id="catnav" class="row secondary">
            <div class="col-sm-12 col-md-8 left-menu">
		<?php wp_nav_menu(array('theme_location' => 'mainNav','container'=> '','menu_id'=> 'catmenu','menu_class'=> 'catnav  container clearfix','fallback_cb' => 'false','depth' => 3)); ?>
            </div>
            <div id="right-menu" class="col-sm-12 col-md-4">
                <form class="search-form">
                    <input type="text" name="s" class="search-text form-control" placeholder="<?php echo __('Tìm kiếm', 'iz_theme'); ?>" />
                           <button type="submit" class="btn-submit"><span class="fa fa-search"></span></button>
                </form>
            </div>
	</div> 
	<!-- /#CatNav -->  
	<?php } ?> 
	
 <?php if($data['ticker_category'] != "0") { ?>	
<script>
 jQuery(document).ready(function () {
 	jQuery.fn.ticker.defaults = {
		speed: 0.10,			
		ajaxFeed: false,
		feedUrl: '',
		feedType: 'xml',
		displayType: 'fade',
		htmlFeed: true,
		debugMode: true,
		controls: true,
		titleText: '<?php echo $data['ticker_title']; ?>',
		direction: 'ltr',	
		pauseOnItems: 3000,
		fadeInSpeed: 600,
		fadeOutSpeed: 300
	};	
 jQuery('#js-news').ticker();
 });
 </script>
<div class="breaking-ticker">
 	<div class="container">
 		<ul id="js-news" class="js-hidden">
				<?php
					$ti_cat = get_cat_ID($data['ticker_category']);
 					$tpcrn_tickerposts = new WP_Query(array(
						'showposts' => $data['ticker_post_no'],
  						'cat' => $ti_cat ,	
  						
  						
					));
 							while( $tpcrn_tickerposts -> have_posts() ) : $tpcrn_tickerposts -> the_post(); ?>
									<li><a  class="news-item" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
									
							<?php  endwhile; wp_reset_query(); ?>

		</ul>
	</div>
 </div>
<?php } ?>
	<!--[if lt IE 8]>
		<div class="msgnote"> 
			Your browser is <em>too old!</em> <a rel="nofollow" href="http://browsehappy.com/">Upgrade to a different browser</a> to experience this site. 
		</div>
	<![endif]-->	
