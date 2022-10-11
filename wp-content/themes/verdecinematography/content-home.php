<?php 
	// Set up the objects needed
	$my_wp_query = new WP_Query();
	$all_wp_pages = $my_wp_query->query(array('post_type' => 'page'));

	$frontpage_id = get_option( 'page_on_front' );
	// Filter through all pages and find Page's children
	$page_children = get_page_children( $frontpage_id, $all_wp_pages );


	if(!empty($page_children)){
		foreach ($page_children as $key => $pc) {
			$template = str_replace('.php','',get_page_template_slug( $pc->ID ));
			$template = str_replace('page-', '', $template);
			//echo $template;
			//print_r($pc);
			set_query_var( 'post_id', absint( $pc->ID ) );
			$style = get_post_meta( $pc->ID, 'style_page', true );
			set_query_var( 'section_css', $style );
			get_template_part( 'page', $template );
		    //return get_query_template( 'page', $templates );
		}


		// echo what we get back from WP to the browser
		//echo '<pre>' . print_r( $page_children, true ) . '</pre>';		
	}

?>