<?php 
add_action( 'init', 'create_post_type_video' );
function create_post_type_video() {
	$labels = array(
		'name'                => _x( 'Video', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Video', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Video', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Video:', 'text_domain' ),
		'all_items'           => __( 'All Video', 'text_domain' ),
		'view_item'           => __( 'View Video', 'text_domain' ),
		'add_new_item'        => __( 'Add New Video', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'edit_item'           => __( 'Edit Video', 'text_domain' ),
		'update_item'         => __( 'Update Video', 'text_domain' ),
		'search_items'        => __( 'Search Video', 'text_domain' ),
		'not_found'           => __( 'No Video found', 'text_domain' ),
		'not_found_in_trash'  => __( 'No Video found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'video', 'text_domain' ),
		'description'         => __( 'Video information pages', 'text_domain' ),
		'labels'              => $labels,
		'supports' => array( 'title', 'editor', 'thumbnail' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_icon'           => 'dashicons-admin-collapse',
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	add_theme_support( 'post-thumbnails' );
	//add_theme_support( 'post-thumbnails', array( 'post','gallery') );
	
	register_post_type( 'video', $args );	
}

function title_video( $title ){
     $screen = get_current_screen();
     if  ( 'video' == $screen->post_type ) {
          $title = 'Enter video name here';
     } 
     return $title;
}
add_filter( 'enter_title_here', 'title_video' );

add_filter('pll_get_post_types', 'my_pll_get_post_video');
function my_pll_get_post_video($types) {
	return array_merge($types, array('video' => 'video'));	
}


function setting_field_video(){
	/**
	 * Class for adding a new field to the options-reading.php page
	 */
	class Add_Settings_Field {

		/**
		 * Class constructor
		 */
		public function __construct() {
			add_action( 'admin_init' , array( $this , 'register_fields' ) );
		}

		/**
		 * Add new fields to wp-admin/options-reading.php page
		 */
		public function register_fields() {
			register_setting( 'reading', 'video_view_val', 'esc_attr' );
			add_settings_field(
				'video_view',
				'<label for="video_view">' . __( 'Video pages show at most' , 'video_view_val' ) . '</label>',
				array( $this, 'fields_html' ),
				'reading'
			);
		}

		/**
		 * HTML for extra settings
		 */
		public function fields_html() {
			$value = get_option( 'video_view_val', '' );
			echo '<input type="number" id="video_view" name="video_view_val" value="' . esc_attr( $value ) . '" class="small-text"/> items';
		}

	}
	new Add_Settings_Field();	
	
}
add_action( 'init', 'setting_field_video' );


?>