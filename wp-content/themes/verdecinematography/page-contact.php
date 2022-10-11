<?php
/**
* Template Name: Page Contact
*/

//get price list data
$args = array('post_type'=>'price-list');
$arr = array();
$the_query = new WP_Query( $args );
while ( $the_query->have_posts() ) {
	$the_query->the_post();
	
	$arr_meta = array('time'=>
								array(	'type'=>'select',
										'title' => 'Time',
										'option'=>array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24),
										'unit_lable'=>'hours'
								)
					);
	$curr_meta = array();
	foreach ($arr_meta as $key => $dt_field) {
		$type = $dt_field['type'];
		$title = $dt_field['title'];
		$value_meta = get_post_meta( $post->ID, $key, true );
		//echo "$value_meta##";
		if($value_meta=="0"){
			$curr_meta[$post->post_name] = $post->post_title;
		}else{
			$curr_meta[$key] = $value_meta;	
		}
		
		//print_r($value_meta);
	}

	array_push($arr,$curr_meta);
}
 

contact_form($post_id,$section_css,$arr);
?>