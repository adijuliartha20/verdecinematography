function send_inquiry(event){
	var error = 0;
	var rfield = ['name','package','email','mobile','country','date','location','additional_info'];
	
	default_reset_after_success(rfield,false);
	document.getElementById("notify-text").innerHTML = '';
   
   //validate required field
	for (i=0; i<rfield.length;i++){
		var el = document.getElementById(rfield[i]);
		if(trim(el.value)==''){
			el.classList.add("error");
			error++;
		} 
	}
	
	
	if(error==0){
		var el_email = document.getElementById('email');
		if(!valid_email(el_email.value)){
			error++;
			el_email.classList.add('error');
			document.getElementById("notify-text").innerHTML = "Invalid email address";
		}
	}
	
	if(error==0){ 
		var el_res = document.getElementById('g-recaptcha-response');
		var response = el_res.value; 
		if(trim(response)==''){
			error++;
			document.getElementById("notify-text").innerHTML = "Please verify use Google Capcha";			
		}
	}
	
	if(error==0){
		var dt =  new Object();
			dt.action = 'inquiry-now';
            dt.name     = jQuery('#name').val();
            dt.package    = jQuery('#package').val();
            dt.email    = jQuery('#email').val();
            dt.mobile  = jQuery('#mobile').val();
            dt.country  = jQuery('#country').val();
            dt.date = jQuery('#date').val();
            dt.location = jQuery('#location').val();
            dt.additional_info = jQuery('#additional_info').val();
            dt.recapcha = jQuery('#g-recaptcha-response').val();
        
        var txt_button = jQuery(event.target).attr('data-onprocess');
        jQuery(event.target).val(txt_button);
            
        jQuery.post(d.url,dt,function(response){
        	var res = jQuery.parseJSON(response);
            if(res.status=='success'){
                jQuery(event.target).val('Success Send Message');
                default_reset_after_success(rfield,true);
            }else{
                jQuery(event.target).val('Failed Send Message');
            }

            setTimeout(function(){
                txt_button = jQuery(event.target).attr('data-onfinish');
                jQuery(event.target).val(txt_button);
            },3000)
	    }) 
	}


	/*if(error==0){
		var name 		= document.contact.name.value;
		var package 	= document.contact.package.value;
		var email 		= document.contact.email.value;
		var phone 		= document.contact.mobile.value;
		var country 	= document.contact.country.value;
		var date 		= document.contact.date.value;
		
		var location 	= document.contact.location.value;
		var additional_info 	= document.contact.additional_info.value;
		var recapcha = jQuery('#g-recaptcha-response').val();

		
		btn.value = 'Please wait...';
		
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			var response  = xhttp.responseText;
			var res = JSON.parse(response);
			//console.log(res);
			
			document.getElementById("notify-text").innerHTML = res.message;
			if(res.status=='success')	{
				default_reset_after_success(rfield,true);	
				notify.classList.add("success");
			}else {
				notify.classList.add("error");
			}
			btn.value = 'Send Message';
			//btn.value = 'Send Message';
		  }
		}
		xhttp.open("POST", d.url, true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		//xhttp.send("action=inquiry-now&name="+name+"&email="+email+"&subject="+subject+"&message="+message+"&response="+response+"");
		
	}*/
	
}

function clearError(){
	this.classList.remove("error");
}	

function valid_email(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

function trim(str) {
	var	str = str.replace(/^\s\s*/, ''),
			ws = /\s/,
			i = str.length;
	while (ws.test(str.charAt(--i)));
	return str.slice(0, i + 1);
}

function remove_element_by_class(name){
	var list = document.getElementsByClassName(name);
   for(var i = list.length - 1; 0 <= i; i--)
   if(list[i] && list[i].parentElement)
   list[i].parentElement.removeChild(list[i]);
}

function default_reset_after_success(array_el,empty){
	for	(i = 0; i < array_el.length; i++) {
		var id = array_el[i];
		var el = document.getElementById(id); 
		if(el.value!="" && empty==true) el.value="";
		el.classList.remove("error");
	}
}


function validate_error(event){
    val = jQuery(event.target).val();
    if(jQuery(event.target).hasClass('error')) jQuery(event.target).removeClass('error');
}