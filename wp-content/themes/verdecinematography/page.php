<?php 
	//echo $post_id;
	$content_post = get_post($post_id);
	//print_r($content_post);
	$content = $content_post->post_content;
	$content = apply_filters('the_content', $content);
	//$content = str_replace(']]>', ']]&gt;', $content);

	$sef = $content_post->post_name;
	?>
	<section id="section-<?php echo $sef;?>" class="section section-page <?php echo 'section-page-'.$sef;?> <?php echo 'section-'.$section_css;?>">
		<?php echo get_triangle_post($post_id);?>
		<div class="middle">
			<div class="content-center">
				<h1 class=""><span><?php echo $content_post->post_title; ?></span></h1>
				<div class="description">
					<?php echo $content; ?>	
				</div>	
			</div>
		</div>		
	</section>
	
	<?php 
?>