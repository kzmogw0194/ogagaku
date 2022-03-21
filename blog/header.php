<!DOCTYPE html>
<html lang="jp">


<?php if( is_single() ) { ?>
<head prefix="og: https://ogp.me/ns# fb: https://ogp.me/ns/fb# article: https://ogp.me/ns/article#">
<?php } else { ?>
<head prefix="og: https://ogp.me/ns# fb: https://ogp.me/ns/fb# website: https://ogp.me/ns/website#">
<?php } ?>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php
global $page, $paged;
if(is_front_page()) : 
	bloginfo('name');
elseif(is_home()) : 
	wp_title('|', true, 'right');
	bloginfo('name');
elseif(is_single()) : 
	wp_title('');
elseif(is_page()) : 
	wp_title('|', true, 'right');
	bloginfo('name');
elseif(is_archive()) : 
	wp_title('|', true, 'right');
	bloginfo('name');
elseif(is_404()): 
	echo '404|';
	bloginfo('name');
endif;
?></title>

<?php echo_meta_description_tag(); ?>

	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" />
	<link rel="apple-touch-icon" sizes="180×180" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png" />

	<?php $google_analytics_tracking_code = get_option('google_analytics_tracking_code'); ?>
<?php if($google_analytics_tracking_code): ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo get_option( 'google_analytics_tracking_code' ); ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?php echo get_option( 'google_analytics_tracking_code' ); ?>');
</script>
<?php else: ?>
<?php endif; ?>



<?php $universal_analytics_tracking_code = get_option('universal_analytics_tracking_code'); ?>
<?php if($universal_analytics_tracking_code): ?>
<!-- Global site tag (gtag.js) - UA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo get_option( 'universal_analytics_tracking_code' ); ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?php echo get_option( 'universal_analytics_tracking_code' ); ?>');
</script>
<?php else: ?>
<?php endif; ?>



<?php $google_tag_manager_tracking_code = get_option('google_tag_manager_tracking_code'); ?>
<?php if($google_tag_manager_tracking_code): ?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','<?php echo get_option( 'google_tag_manager_tracking_code' ); ?>');</script>
<!-- End Google Tag Manager -->
<?php else: ?>
<?php endif; ?>

<?php $google_search_console_tracking_code = get_option('google_search_console_tracking_code'); ?>
<?php if($google_search_console_tracking_code): ?>
<!-- サーチコンソール確認コード -->
<?php echo get_option( 'google_search_console_tracking_code' ); ?>
<!-- End サーチコンソール確認コード  -->
<?php else: ?>
<?php endif; ?>

<?php wp_head(); ?>
</head>

<body>
<?php //サイトヘッダーからコンテンツまでbodyタグ最初のHTML
get_template_part('tmp/body-top'); ?>
 
		    