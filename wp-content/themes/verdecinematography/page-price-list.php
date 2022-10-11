<?php
/**
* Template Name: Page Price List
*/
$args = array('post_type'=>'price-list');
                            
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
	
	?>
	<section id="section-price-list" class="section section-price-list <?php echo 'section-'.$section_css;?>">
	<?php
		echo get_triangle_post($post_id);

	$arr = array();
    while ( $the_query->have_posts() ) {
		$the_query->the_post();//print_r($post);
		$arr_meta = arr_adf_price_list();
		$curr_meta = array();
		$curr_meta['post_title'] = $post->post_title;
		$curr_meta['post_name'] = $post->post_name;
		foreach ($arr_meta as $key => $dt_field) {
			$type = $dt_field['type'];
			$title = $dt_field['title'];
			$value_meta = get_post_meta( $post->ID, $key, true );
			$curr_meta[$key] = $value_meta;
		}
		//print_r($post);		
		array_push($arr,$curr_meta);
		//print_r($curr_meta);
    }
   //print_r($arr);
    if(!empty($arr)){?>
    	<div class="middle">
    		<h1 class="custom-h1"><span>Purchase a</span> Package</h1>
    		<div id="list-price-clone" class="hide"></div>
    		<div id="list-price" class="list-price clearfix">
	    	<?php
	    	foreach ($arr as $key => $dtp) {
	    		$time = $dtp['time'] + 1;

	    		?>
	    		<div class="item-price item-price-<?php echo $dtp['post_name']; ?> fleft">
	    			<div class="field-item-price item">
	    				<div class="middle-item-price">
	    					<div class="inside-item-price">
	    						<h2><?php echo $dtp['post_title']; ?></h2>	
	    					</div>	    					
	    				</div>	    				
	    			</div>
	    			<div class="field-item-price price <?php echo (!empty($dtp['price_second']) ? 'has-second-price':''); ?>">
	    				<div class="middle-item-price">
	    					<div class="inside-item-price">
	    						<h3 class=""><?php echo 'US $'.$dtp['price']; ?></h3>
	    						<?php if(!empty($dtp['price_second'])) {
	    							?>
	    							<h3 class=""><?php echo 'US $'.$dtp['price_second']; ?></h3>
	    							<?php
	    						}?>	
	    					</div>	    					
	    				</div>	    				
	    			</div>
	    			<div class="field-item-price see-detail hide">
	    				<div class="middle-item-price">
	    					<div class="inside-item-price">
	    						<button class="see-detail-model" onClick="see_details_package(event)" data-rel="<?php echo $key;?>">See Details</button>
	    					</div>	    					
	    				</div>	    				
	    			</div>
	    			<div id="details-package-<?php echo $key; ?>" class="hide-mobile-detail">
		    			<div class="field-item-price videographer">
		    				<div class="middle-item-price">
		    					<div class="inside-item-price">
		    						<div class=""><?php echo $dtp['videographers'].' Videographers'; ?></div>	
		    					</div>	    					
		    				</div>	    				
		    			</div>

		    			<?php if(!empty($dtp['camera'])){?>
		    			<div class="field-item-price camera">
		    				<div class="middle-item-price">
		    					<div class="inside-item-price">
		    						<div class=""><?php echo $dtp['camera']; ?></div>	
		    					</div>	    					
		    				</div>	    				
		    			</div>
		    			<?php } ?>	
		    			
		    			<div class="field-item-price tools">
		    				<div class="middle-item-price">
		    					<div class="inside-item-price">
		    						<div class=""><?php echo $dtp['tools'];?></div>	
		    					</div>	    					
		    				</div>	    				
		    			</div>
		    			<div class="field-item-price lbl-result">
		    				<div class="middle-item-price">
		    					<div class="inside-item-price">
		    						<label class="">Final Result :</label>	
		    					</div>	    					
		    				</div>	    				
		    			</div>
		    			<div class="field-item-price final-result">
		    				<div class="middle-item-price">
		    					<div class="inside-item-price">
		    						<div class=""><?php echo $dtp['final_result']; ?></div>	
		    					</div>	    					
		    				</div>	    				
		    			</div>
	    			</div>
	    			<div class="field-item-price btn-check-available">
	    				<button class="btn-green" data-package="<?php echo $time;?>" onClick="select_package(event)">CHECK AVAILABLE</button>
	    			</div>
	    		</div>
	  <?php	}//end foreach price

	    	?>
    		</div>
    	</div>
    	<?php 
    }
    
    ?>
    </section>	
    <?php 	
}
?>