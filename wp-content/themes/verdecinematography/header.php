<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="apple-touch-fullscreen" content="yes" />

  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width,height=device-height">

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
  <?php 
    $meta_desc = get_option( 'blogdescription', '' );
    $meta_keywords = get_option( 'meta_keywords', '' );

    if($meta_desc!=''){
      ?>
        <meta name="description" content="<?php echo $meta_desc; ?>">
      <?php
    }

    if($meta_keywords!=''){
      ?>
        <meta name="keywords" content="<?php echo $meta_keywords; ?>">
      <?php
    }
  ?> 
  


  <meta name="google-site-verification" content="_nMv2z8tV6uIaxlCRm2IrVOeYDq-MNkJQp8dbX0CV8Q" />
  <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">
  <?php wp_head(); ?>

  <?php
  $version = '?v=1.2.7'.time();
  //$version = '';
  ?>
  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri().'/style.css'.$version ?>">
  <script type="text/javascript" src="<?php echo get_template_directory_uri().'/js/jquery-3.1.1.min.js'.$version ?>"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri().'/js/slick/slick.js'.$version ?>"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri().'/js/vegas/vegas.min.js'.$version ?>"></script>
  
  <script type="text/javascript" src="<?php echo get_template_directory_uri().'/js/select2/js/select2.min.js'.$version ?>"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri().'/js/scrollreveal-master/scrollreveal.min.js'.$version ?>"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri().'/js/jquery_lazyload-1.9.7/jquery.lazyload.js'.$version ?>"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri().'/js/jquery-ui-1.12.1/jquery-ui.min.js'.$version ?>"></script> 


  <script type="text/javascript" src="<?php echo get_template_directory_uri().'/js/lightcase-master/src/js/lightcase.js'.$version ?>"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri().'/js/readmore.min.js'.$version ?>"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri().'/js/script.js'.$version ?>"></script>


</head>
<body class="body page-index clearfix">
<!-- Header Start -->
<div id="mobilenav" class="mobilenav">
  <div class="middle-mv">
    <div class="center">
      <?php 
        wp_nav_menu( 
              array(
                  'menu' => 'Menu',
                  'menu_id'=> 'menu-mobile',
                  'menu_class'=>'mobile-menu clearfix',
                  'link_before'     => '<span>',
                  'link_after'      => '</span>',
              ) 
          );
      ?>
    </div>  
  </div>  
</div>
<!--<div class="container-header-scroll">-->
  <div id="header-scroll" class="header-scroll clearfix">
    <div class="middle">
      <a href="javascript:void(0)" class="icon hide">
        <div class="hamburger">
          <div class="menui top-menu"></div>
          <div class="menui mid-menu"></div>
          <div class="menui bottom-menu"></div>
        </div>
      </a> 
       <?php 
        wp_nav_menu( 
              array(
                  'menu' => 'Menu',
                  'menu_id'=> 'menu-header-scroll',
                  'menu_class'=>'menu-header-scroll clearfix',
                  'link_before'     => '<span>',
                  'link_after'      => '</span>',
              ) 
          );
      ?>

      <?php 
        $opt = get_option('my_option_name');
        if( (isset($opt['facebook']) && !empty($opt['facebook'])) || (isset($opt['instagram']) && !empty($opt['instagram'])) ) {
          ?>
          <div class="list-sosmed">
          <?php 
        }
            if(isset($opt['facebook']) && !empty($opt['facebook'])){
              ?>
              <a class="facebook" href="<?php echo $opt['facebook'];?>" ></a>
              <?php 
            }
            if(isset($opt['instagram']) && !empty($opt['instagram'])){
              ?>
              <a class="instagram" href="<?php echo $opt['instagram'];?>" ></a>
              <?php 
            }
        if( (isset($opt['facebook']) && !empty($opt['facebook'])) || (isset($opt['instagram']) && !empty($opt['instagram'])) ) {
          ?>
          </div>
          <?php 
        }
      ?> 
    </div>
  </div>
<!--</div>-->


<div id="header" class="header">
  <div class="middle clearfix">
    <a href="javascript:void(0)" class="icon">
      <div class="hamburger">
        <div class="menui top-menu"></div>
        <div class="menui mid-menu"></div>
        <div class="menui bottom-menu"></div>
      </div>
    </a>

    <?php 
      
      if(isset($opt['phone']) && !empty($opt['phone'])){
        ?>
        <a class="whatapps" href="whatsapp://<?php echo $opt['phone'];?>" ><?php echo $opt['phone'];?></a>
        <?php 
      }
    ?>
    <img class="logo-header" src="<?php echo get_template_directory_uri().'/images/logo-white.png?v='.time(); ?>">
    <?php 
      if( (isset($opt['facebook']) && !empty($opt['facebook'])) || (isset($opt['instagram']) && !empty($opt['instagram'])) ) {
        ?>
        <div class="list-sosmed">
        <?php 
      }
          if(isset($opt['facebook']) && !empty($opt['facebook'])){
            ?>
            <a class="facebook" href="<?php echo $opt['facebook'];?>" ></a>
            <?php 
          }
          if(isset($opt['instagram']) && !empty($opt['instagram'])){
            ?>
            <a class="instagram" href="<?php echo $opt['instagram'];?>" ></a>
            <?php 
          }
      if( (isset($opt['facebook']) && !empty($opt['facebook'])) || (isset($opt['instagram']) && !empty($opt['instagram'])) ) {
        ?>
        </div>
        <?php 
      }
    ?>



    <div class="menu">
      <?php 
        wp_nav_menu( 
              array(
                  'menu' => 'Menu',
                  'menu_class'=>'container-23 clearfix',
                  'link_before'     => '<span>',
                  'link_after'      => '</span>',
              ) 
          );
      ?>
    </div>  

  </div>
  

</div>
<!-- Header End -->