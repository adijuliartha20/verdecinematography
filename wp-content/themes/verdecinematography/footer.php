<!-- Footer Start -->
<?php $opt = get_option('my_option_name'); ?>
<div class="footer">
	<div class="middle">
		<img class="logo-footer" src="<?php echo get_template_directory_uri().'/images/logo-white.png?v='.time() ?>">
		<div class="menu">
	      <?php 
	        wp_nav_menu( 
	              array(
	                  'menu' => 'Menu',
	                  'menu_class'=>'menu-footer clearfix',
	                  'link_before'     => '<span>',
	                  'link_after'      => '</span>',
	              ) 
	          );
	      ?>
	    </div> 
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
		} ?>

		<div class="copy-right">&copy; <?php echo date('Y');?> Verde Wedding Cinematography. All Rights Reserved.</div>	
	</div>
</div>
<!-- Footer End -->  
<?php wp_footer(); ?>
<!-- Google Code for verde_report Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 944760707;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "ViOfCL60g3IQg8-_wgM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/944760707/?label=ViOfCL60g3IQg8-_wgM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
</body>
</html>