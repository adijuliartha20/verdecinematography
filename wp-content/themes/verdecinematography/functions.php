<?php 

//@ini_set( 'upload_max_filesize' , '100M' );

//@ini_set( 'post_max_size', '100M');

//@ini_set( 'max_execution_time', '300' );





function theme_name_scripts() {

	wp_enqueue_style( 'standardize', get_template_directory_uri().'/standardize.css' );

	wp_enqueue_style( 'slick', get_template_directory_uri().'/js/slick/slick.css' );

	wp_enqueue_style( 'slick-theme', get_template_directory_uri().'/js/slick/slick-theme.css' );

	wp_enqueue_style( 'vegas', get_template_directory_uri().'/js/vegas/vegas.min.css');

	wp_enqueue_style( 'magnificient_popup', get_template_directory_uri().'/js/magnific-popup/magnific-popup.css');

	wp_enqueue_style( 'select_2', get_template_directory_uri().'/js/select2/css/select2.min.css');

	wp_enqueue_style( 'jquery-ui', get_template_directory_uri().'/js/jquery-ui-1.12.1/jquery-ui.min.css');

	wp_enqueue_style( 'lightcase', get_template_directory_uri().'/js/lightcase-master/src/css/lightcase.css');

	//wp_enqueue_style( 'style', get_stylesheet_uri() );

	

	

	/*wp_enqueue_script( 'jquery-js-v', get_template_directory_uri().'/js/jquery-3.1.1.min.js', array(), '1.0.0', true );

	wp_enqueue_script( 'slick-v', get_template_directory_uri().'/js/slick/slick.js', array(), '1.0.1', true );

	wp_enqueue_script( 'vegas-v', get_template_directory_uri().'/js/vegas/vegas.min.js', array(), '1.0.0', true );

	wp_enqueue_script( 'script-v', get_template_directory_uri() . '/js/script.js', array( 'jquery' ) );*/



	//wp_localize_script('script','lb',array('ajaxurl'=>admin_url('admin-ajax.php'),));

}



add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );





require_once('functions_price_list.php');

require_once('functions_video.php');

require_once('functions_page.php');

require_once('functions_social_media_contact.php');



$current_user = wp_get_current_user();

$rule = $current_user->roles[0];

if($rule=='editor'){

	add_action( 'admin_menu', 'custom_menu_page_removing' );

}



function custom_menu_page_removing() {

	remove_menu_page( 'index.php' );

    remove_menu_page('edit.php' );

    remove_menu_page( 'upload.php' );

    remove_menu_page( 'edit-comments.php' );  

    remove_menu_page( 'tools.php' );

}





$new_general_setting = new new_general_setting();



class new_general_setting {

    function new_general_setting( ) {

        add_filter( 'admin_init' , array( &$this , 'register_fields' ) );

    }

    function register_fields() {

        register_setting( 'general', 'meta_keywords', 'esc_attr' );

        add_settings_field('fav_color', '<label for="meta_keywords">'.__('Meta Keywords' , 'meta_keywords' ).'</label>' , array(&$this, 'fields_html') , 'general' );

    }

    function fields_html() {

        $value = get_option( 'meta_keywords', '' );

        echo '<textarea  id="meta_keywords" name="meta_keywords" class="large-text" rows="8">'.$value.'</textarea>';

        //echo '<input type="text" id="meta_keywords" name="meta_keywords" value="' . $value . '" />';

    }

}





?>