<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section
 *
 */
?><!doctype html>
<!--[if lt IE 7 ]> <html class="ie6 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <title><?php

  global $page, $paged;

  wp_title( '|', true, 'right' );

  bloginfo( 'name' );

  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) )
      echo " | $site_description";

  if ( $paged >= 2 || $page >= 2 )
      echo ' | ' . sprintf( __( 'Page %s', 'starkers' ), max( $paged, $page ) );

  ?></title>

  <link rel="profile" href="http://gmpg.org/xfn/11" />

  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

  <meta name="author" content="elefint.com">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
  <link rel="manifest" href="/manifest.json">
  <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="theme-color" content="#ffffff">

  <script src="<?php echo get_stylesheet_directory_uri();?>/js/modernizr.min.js"></script>

  <?php
    $o_gacode = get_option('wedevs_ga');
    if(count($o_gacode))
      // extract($o_gacode);
  ?>

  <?php if ( $ga_code && !is_admin() ) : ?>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', '<?php echo $ga_code;?>', 'auto');
      ga('send', 'pageview');

    </script>
  <?php endif; ?>


  <?php wp_head();?>

</head>

<body <?php body_class(); ?>>

 <div class="wrapper">

  <nav class="navigation">
    <?php
      $args = array(
        'container' => false,
        'theme_location' => 'primary',
        'items_wrap'      => '<ul id="navigation" class="j-row ib-fix %2$s">%3$s</ul>'
        );

      wp_nav_menu($args);
    ?>
  </nav>

  <a href="#" id="toggle-menu" class="toggle-menu"></a>
  <a href="#" id="toggle-menu-close" class="toggle-menu-close"></a>
  <div class="blue-bottom-triangle"></div>
  <!-- / navigation -->

  <section class="banner">
    <div class="row">
      <img class="txt-block-center" src="<?php echo get_stylesheet_directory_uri();?>/img/ico_26.svg" width="115" height="100" alt="" />
      <h1 class="txt-ib-center">Kolokwia Psychologiczne</h1>
      <h2 class="txt-ib-center"><?php bloginfo( 'description' );?></h2>
    </div>;?>
    <div class="img-banner-container j-row ib-fix">
      <a href="#"><img src="<?php echo get_stylesheet_directory_uri();?>/img/ico_pan.png" width="100" height="80" alt="" /></a>
      <a href="#"><img src="<?php echo get_stylesheet_directory_uri();?>/img/ico_ukw.png" width="94" height="94" alt="" /></a>
    </div>
  </section>
