<?php 
/*
Plugin Name: Contact
Plugin URI: http://www.locografis.com
Description: Simple Contact from Loco Grafis
Author: Adi Juliartha
Author URI: http://www.locografis.com 
Version: 1.0.0/
*/

function inquiry_now(){	
	$return = array();
	if(valid_capcha_value($_POST['recapcha'])){
		$message = temp_email($_POST['name'],$_POST['package'],$_POST['email'],$_POST['mobile'],$_POST['country'],$_POST['date'],$_POST['location'],$_POST['additional_info']);	

		$name_from = $_POST['name'];
		$email_from = $_POST['email'];
		$name_to = get_option('blogname');
		$email_to = get_option('admin_email');

		if(send_email_mailer($name_from,$email_from,$name_to,$email_to,$message)){
			$return['status']='success';
			$return['message']= 'Thank you for your inquiry we will get back to you as soon as possible.';
		}else{
			$return['status']='failed';
			$return['to']=$to;
			$return['message']= 'Failed send email. Please try again later.';
		}
	}else{
		$return['status'] = 'failed';
		$return['message'] = 'Error capcha validation. Failed to send inquiry.';
	}

	//if(valid_capcha_value('')) {
		/**/
	//else{}


	
	echo json_encode($return);
	die();
}

function valid_capcha_value($response){
	$recapcha = get_option('recapcha');
	$secret = $recapcha['secret_key'];
	$remoteip = $_SERVER["REMOTE_ADDR"];
	
	$postdata = http_build_query(
		array(
			'secret' => $secret,
			'response' => $response,
			'remoteip' => $remoteip
		)
	);
	
	$opts = array('http' =>
		array(
			'method'  => 'POST',
			'header'  => 'Content-type: application/x-www-form-urlencoded',
			'content' => $postdata
		)
	);
	//print_r($postdata);
	$context  = stream_context_create($opts);
	$result = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
	$result = json_decode($result);
	if($result->success) return true;
	else return false;
}


function temp_email($name,$package,$email,$mobile,$country,$date,$location,$additional_info){
	$temp = '<table>
				<tr>
					<td style="width:100px;">Name</td>
					<td style="width:10px;">:</td>
					<td>'.$name.'</td>
				</tr>
				<tr>
					<td style="width:100px;">Package</td>
					<td style="width:10px;">:</td>
					<td>'.$package.'</td>
				</tr>
				<tr>
					<td style="width:100px;">Email</td>
					<td style="width:10px;">:</td>
					<td>'.$email.'</td>
				</tr>
				<tr>
					<td style="width:100px;">Phone</td>
					<td style="width:10px;">:</td>
					<td>'.$mobile.'</td>
				</tr>
				<tr>
					<td style="width:100px;">Country</td>
					<td style="width:10px;">:</td>
					<td>'.$country.'</td>
				</tr>
				<tr>
					<td style="width:100px;">Date</td>
					<td style="width:10px;">:</td>
					<td>'.$date.'</td>
				</tr>
				<tr>
					<td style="width:100px;">Location</td>
					<td style="width:10px;">:</td>
					<td>'.$location.'</td>
				</tr>
				<tr>
					<td style="width:100px;">Additional Info</td>
					<td style="width:10px;">:</td>
					<td>'.nl2br($additional_info).'</td>
				</tr>
			</table>';
	return $temp;		
}


add_action( 'wp_ajax_nopriv_inquiry-now', 'inquiry_now' );
add_action( 'wp_ajax_inquiry-now', 'inquiry_now' );



function send_email_mailer($name_from,$email_from,$name_to,$email_to,$content){
	require 'phpMailer/class.phpmailer.php';
	$mail = new PHPMailer(true);
	$opt = get_option('my_option_name');
	$subject = $opt['subject_email'];
	$email_smtp = $opt['email_smtp_custom'];
	$pass_smtp = $opt['pass_smtp_custom'];
	$SMTP_PORT =  $opt['port_smtp_server'];
	$host = $opt['smtp_server'];
	


	try {
		//Create a new PHPMailer instance
		//$mail->SMTPDebug  = 1;
		$mail->IsSMTP();
		$mail->Host = $host;
		$mail->SMTPAuth = true;
		$mail->Port       = $SMTP_PORT; 
		$mail->Username   = $email_smtp;  // GMAIL username
		$mail->Password   = $pass_smtp; // GMAIL password

		$mail->AddReplyTo($email_from,$name_from);
		$mail->AddAddress($email_to,$name_to); //karena kirim ke diri sendiri
		$mail->SetFrom($email_smtp, $name_from);
		$mail->Subject = $subject;
		$mail->MsgHTML($content);
		$mail->Send();
		return true;
	}catch (phpmailerException $e) {
		return false;
	}catch (Exception $e) {
		return false;
	}

	
}




/*function send_email_mailer($name_from,$email_from,$name_to,$email_to,$content,$subject){
	//require_once(ROOT_PATH.'/phpMailer/class.phpmailer.php');
	require_once('PHPMailer/class.phpmailer.php' );
	$mail = new PHPMailer(true);
	$SMTP_SERVER = get_meta_data('smtp');
	$SMTP_PORT 	= 2525;
	$email_smtp			= 'adi@lumonatalabs.com';
	$pass_smtp 			= 'adijuli789';
	
	try {
		$mail->SMTPDebug  = 1;
		$mail->IsSMTP();
		$mail->Host = $SMTP_SERVER;
		$mail->SMTPAuth = false;
		$mail->Port       = $SMTP_PORT; 
		$mail->Username   = $email_smtp;  // GMAIL username
		$mail->Password   = $pass_smtp; // GMAIL password

		$mail->AddReplyTo($email_from,$name_from);
		$mail->AddAddress($email_to,$name_to); //karena kirim ke diri sendiri
		$mail->SetFrom($email_smtp, $name_from);
		$mail->Subject = $subject;
		$mail->MsgHTML($content);
		$mail->Send();
		return true;
	}catch (phpmailerException $e) {
		echo $e;
		return false;
	}catch (Exception $e) {
		return false;
	}
}*/






function contact_form($post_id,$section_css='',$arr=array()){	
	wp_enqueue_script('contact-form-js-1',plugin_dir_url( __FILE__ ) . 'script.js',false,'1.1',true);
	wp_localize_script('contact-form-js-1','d',
											array(
												'url'=>admin_url('admin-ajax.php'),
												
												)
									);
	
	$recapcha = get_option('recapcha');
	wp_enqueue_script('google-capcha','https://www.google.com/recaptcha/api.js',false,'1.1',true);

	//get package
	$option_package = '<option value="">Choose Package</option>';
	
	foreach ($arr as $key => $dtp) {
		foreach ($dtp as $kd => $value) {
			if($kd!='time'){
				$option_package .= '<option value="'.$kd.'">'.$value.'</option>';
			}else{
				$time = $value + 1;
				$option_package .= '<option value="'.$time.'">'.$time.' Hours</option>';
			}
		}		
	}

	$opt = get_option('my_option_name');
	$email = get_option( 'admin_email' );
	//$link_address = get_option( 'link_address' );
	$phone = (isset($opt['phone']) && !empty($opt['phone']) ? $opt['phone'] : '').(isset($opt['phone_2']) && !empty($opt['phone_2']) ? ' / '.$opt['phone_2'] : '');


?>
	<div id="section-contact-us" class="section section-contact  <?php echo 'section-'.$section_css;?>">
		<?php echo get_triangle_post($post_id);?>
		<div class="middle">
			<h1>Contact Us</h1>
	        <form id="contact" name="contact" class="form clearfix">
	        	<div class="field">
	        		<input class="_input require" placeholder="Name (required)" type="text" name="name" id="name"  onkeyup="validate_error(event)" onchange="validate_error(event)">
	        	</div>

	        	<div class="half_field half_field_left">
	        		<select name="package" id="package" class="_select require"  onkeyup="validate_error(event)" onchange="validate_error(event)">
	        			<?php echo $option_package; ?>
	        		</select>
	        	</div>
	        	<div class="half_field half_field_right">
	        		<input class="_input require" placeholder="Email (required)" type="text" name="email" id="email"  onkeyup="validate_error(event)" onchange="validate_error(event)">
	        	</div>
	        	<div class="half_field half_field_left">
	        		<input class="_input" placeholder="Mobile Phone" type="text" name="mobile" id="mobile"  onkeyup="validate_error(event)" onchange="validate_error(event)">
	        	</div>
	        	<div class="half_field half_field_right">
	        		<input class="_input" placeholder="Country of Origin" type="text" name="country" id="country"  onkeyup="validate_error(event)" onchange="validate_error(event)">
	        	</div>
	        	<div class="half_field half_field_left">
	        		<input class="_input" placeholder="Wedding Date" type="text" name="date" id="date"  onkeyup="validate_error(event)" onchange="validate_error(event)">
	        	</div>
	        	<div class="half_field half_field_right">
	        		<input class="_input" placeholder="Location" type="text" name="location" id="location"  onkeyup="validate_error(event)" onchange="validate_error(event)">
	        	</div>
	        	<div class="field">
	        		<textarea class="_textarea" name="additional_info" id="additional_info" placeholder="Additional Info (required)" onkeyup="validate_error(event)" onchange="validate_error(event)"></textarea>
	        	</div>

	            <div class="field">
	            <?php echo html_entity_decode($recapcha['snipset']);?>
	            </div>
	        </form>        
	        <input type="button" class="btn-green" onclick="send_inquiry(event)" value="Send Message" data-onprocess="Please wait..." data-onfinish="Send message" />
	        <div id="notify" class="notify">
	        	<div id="notify-text"></div>
	        </div>

	        <div class="address-detail">
	        	<label>Meeting by appointment</label>	
	        	<ul class="clearfix">
	        		<?php if(isset($opt['address']) && !empty($opt['address'])){ ?>
						<li class="address">
							<a href="<?php echo $opt['link_address']; ?>" target="new_tab">
								<?php echo $opt['address'];?>		
							</a>
						</li>	
					<?php }?>

					<?php if(isset($email) && !empty($email)){ ?>
						<li class="email"><?php echo $email;?></li>	
					<?php }?>
					<?php if(isset($phone) && !empty($phone)){ ?>
						<li class="phone"><?php echo $phone;?></li>	
					<?php }?>
	        	</ul>
	        </div>	

		</div>
        
    </div>
<?php }

?>