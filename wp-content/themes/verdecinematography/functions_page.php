<?php 
function wpdocs_register_meta_boxes_page() {
	$screens = array('page');
    foreach ( $screens as $screen ) {
    	add_meta_box( 'meta-box-id-'.$screen, __( 'Additional Field', 'textdomain' ), 'wpdocs_my_display_callback_page', $screen );	
    }
    
}
add_action( 'add_meta_boxes', 'wpdocs_register_meta_boxes_page' );

function wpdocs_my_display_callback_page( $post ) {
    // Display code/markup goes here. Don't forget to include nonces!
    // Add an nonce field so we can check for it later.
	wp_nonce_field( 'myplugin_inner_custom_box_page', 'myplugin_inner_custom_box_page_nonce' );
	$arr_meta = arr_meta_page();

	foreach ($arr_meta as $key => $dt_field) {
		$type = $dt_field['type'];
		$title = $dt_field['title'];
		$value_meta = get_post_meta( $post->ID, $key, true );
		$w_title = (isset($dt_field['width-title']) ? $dt_field['width-title'] : '100');

		echo '<div style="margin-bottom:10px;'.(isset($dt_field['custom-style']) ? $dt_field['custom-style']:'').'"><label for="'.$key.'" style="width:'.$w_title.'px; float:left; margin-top:5px">';
		   _e( $title, 'myplugin_textdomain' );
		echo '</label> ';

		if($type=='select'){
			$options = $dt_field['option'];
			echo '<select id="'.$key.'" name="'.$key.'" >';
			foreach ($options as $key_opt => $label) {
				echo '<option value="'.$key_opt.'" '.($key_opt==$value_meta?'selected':'').'>'.$label.'</option>';
			}
			echo '</select>';
		}else{	
			echo '<input type="text" id="'.$key.'" name="'.$key.'" value="' . esc_attr( $value_meta ) . '" size="70" />';
		}
		echo '<br/></div>'.(isset($dt_field['br']) && $dt_field['br']? '<div style="clear:both; display:table;"></div>':'' );
		
	}
}


function arr_right_triangle_position(){
	return array(	''=>'None',
					'top top-left'=>'Top Left',
					'top top-right'=>'Top Right',
					'bottom bottom-left'=>'Bottom Left',
					'bottom bottom-right'=>'Bottom Right'
				);
}

function arr_right_triangle_color(){
	return array(
				''=>'',
					'white'=>'White',
				 	'black'=>'Black',
				 	'gray'=>'Gray'
				);
}

function arr_key_meta_page(){

}

function arr_meta_page(){
	return array('style_page'=>
								array(	'type'=>'select',
										'title' => 'Style Page',
										'option'=>array('white'=>'White','black'=>'Black','gray'=>'Gray')
									),	
						'right_triangle_1' => array(	'type'=>'select',
														'title' => 'Right Triangle 1',
														'option'=> arr_right_triangle_position(),
														'custom-style' => 'float:left;'
													)
						,
						'right_triangle_1_color' => array('type'=>'select',
														'title' => 'Color',
														'option'=> arr_right_triangle_color(),
														'custom-style' => 'float:left; margin-left: 40px;',
														'width-title' => 60,
														'br' => true
													),
						'right_triangle_2' => array(	'type'=>'select',
														'title' => 'Right Triangle 2',
														'option'=> arr_right_triangle_position(),
														'custom-style' => 'float:left;'
													)
						,
						'right_triangle_2_color' => array('type'=>'select',
														'title' => 'Color',
														'option'=> arr_right_triangle_color(),
														'custom-style' => 'float:left; margin-left: 40px;',
														'width-title' => 60,
														'br' => true
													),
						'right_triangle_3' => array(	'type'=>'select',
														'title' => 'Right Triangle 3',
														'option'=> arr_right_triangle_position(),
														'custom-style' => 'float:left;'
													)
						,
						'right_triangle_3_color' => array('type'=>'select',
														'title' => 'Color',
														'option'=> arr_right_triangle_color(),
														'custom-style' => 'float:left; margin-left: 40px;',
														'width-title' => 60,
														'br' => true
													),
						'right_triangle_4' => array(	'type'=>'select',
														'title' => 'Right Triangle 4',
														'option'=> arr_right_triangle_position(),
														'custom-style' => 'float:left;'
													)
						,
						'right_triangle_4_color' => array('type'=>'select',
														'title' => 'Color',
														'option'=> arr_right_triangle_color(),
														'custom-style' => 'float:left; margin-left: 40px;',
														'width-title' => 60,
														'br' => true
													)
				);
}

function wpdocs_save_meta_box_page( $post_id ) {
    // Save logic goes here. Don't forget to include nonce checks!
    if ( ! isset( $_POST['myplugin_inner_custom_box_page_nonce'] ) )return $post_id;  
	$nonce = $_POST['myplugin_inner_custom_box_page_nonce'];  
	if (! wp_verify_nonce( $nonce, 'myplugin_inner_custom_box_page' ))return $post_id;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )  return $post_id;

	// Check the user's permissions.
	if ( 'page' == $_POST['post_type'] ) {
	if ( ! current_user_can( 'edit_page', $post_id ) ) return $post_id;
	} else { 
		if ( ! current_user_can( 'edit_post', $post_id ) ) return $post_id;
	}

	//$arr_meta = array('price'=>'Price', 'additional-1'=>'Additional 1');
	$arr_meta = arr_meta_page();
	foreach ($arr_meta as $key => $title) {
		$value_meta = sanitize_text_field( $_POST[$key] );
		update_post_meta( $post_id, $key, $value_meta);
	}
}
add_action( 'save_post', 'wpdocs_save_meta_box_page' );


function get_triangle_post($post_id=''){
	if(!empty($post_id)){
		$max_triangle = 4;
		$right_triangle = '';

		for($i=1; $i<=$max_triangle;$i++){
			$triangle_pos = get_post_meta($post_id, 'right_triangle_'.$i, true );
			$triangle_color = get_post_meta($post_id, 'right_triangle_'.$i.'_color', true );
			if($triangle_pos!=''){
				$dt_triangle_pos = explode(' ',$triangle_pos);
				$pos = trim($dt_triangle_pos[0]);
				$pos_fix = trim($dt_triangle_pos[1]);
				$right_triangle .= '<div class="right-triangle right-triangle-'.$pos.' right-triangle-'.$pos_fix.' right-triangle-'.$triangle_color.'"></div>';
			}
		}

		echo $right_triangle;
	}
}

?>