<?php
/**
* Template Name: Page Slide
*/

$gallery = get_post_gallery($post_id, false );
$ids = explode(',',$gallery['ids']);
if(!empty($ids)){
	$list_input = '';
	foreach($ids as $id) : 
		$large = wp_get_attachment_image_src( $id, 'large');
		$img = $large[0];
		$list_input .= '<input type="hidden" value="'.$img.'">';	
	endforeach;
	?>
	<div class="wrap-slide">
		<?php echo get_triangle_post($post_id);?>
		<div id="slide" class="slide">
			<?php echo $list_input; ?>
		</div>
	</div>
	
	<?php 
}

?>
