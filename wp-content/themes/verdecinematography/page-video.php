<?php
/**
* Template Name: Page Video
*/

//echo '#di video =>'.$post_id;
//<div class="video">Video</div>


$args = array('post_type'=>'video');
                            
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
	$arr = array();
    $title = get_post_field('post_title', $post_id);


    
    while ( $the_query->have_posts() ) {
        $the_query->the_post();        
        $video = explode('ids="',$post->post_content);
        if(isset($video[1])){
        	$video = explode('"', $video[1]);
	        $video = $video[0];
	        $video = get_the_guid($video);
	        $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID ),'medium');
            $image_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID ),'thumbnail');
	        array_push($arr,array('image'=>$image[0], 'video'=>$video, 'image_thumb'=>$image_thumb[0]));
        }
    }



    
    if(!empty($arr)){
        $list_video = '';
        foreach ($arr as $i => $vid) {
            $list_video .= '<input type="hidden" value="'.$vid['video'].'" data-image="'.$vid['image'].'" data-image_thumb="'.$vid['image_thumb'].'">';
        }
        $pagging = get_option( 'video_view_val', '' );

        /*$title_html = 
        $string = 'an example';
        echo preg_replace('/^\b(.+?)\b/i', '<b>$1</b>', $string);*/

        ?>
        <section id="section-video" class="section section-page-video section-video">
            <?php echo get_triangle_post($post_id);?>
            <h1 class="custom-h1"><?php echo preg_replace('/^\b(.+?)\b/i', '<span>$1</span>', $title);?></h1>
            <div id="list-video" class="list-video"><?php echo $list_video; ?></div>
            <input type="hidden" id="pagg-video" value="<?php echo $pagging; ?>"></input>
        </section>
        <?php 
    }

    //print_r($arr);
}
?>


