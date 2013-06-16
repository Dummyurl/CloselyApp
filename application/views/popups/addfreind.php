<?php $this->load->helper('url'); ?>	
<html class="no-js">	
	<head>
		<?php $this->load->view('head/css'); ?>
		<script src="<?php echo base_url();?>asset/js/jquery-1.8.2.min.js"></script>
	</head>	
	<body>	
	<div class="popup">
		<div class="head_title qrpb"><span>הוסף חבר</span></div>
		<div class="request_row"><span class="coupon_name"><?php echo $user[0]->user_name; ?></span><span> - בקשת חברות מ</span></div>
		<div class="request_content">
			<div class="requester_image"><img src="https://graph.facebook.com/<?php echo $user[0]->user_id; ?>/picture?type=large"  /></div>
			<div class="requester_text"><textarea>היי , אשמח אם תצטרף לרשימת החברים שלי</textarea></div>
		</div>
		<div class="captcha_container">
			<div class="captcha_fill"><input type="text" value="הזן את הטקסט שבתמונה" name="captcha" id="captchField"></div>
			<div class="captcha"><?php echo $image ?></div>	
		</div>
		<div id="error_message" class="notif"></div>	
		<img id="sending" src="<?php echo base_url();?>asset/img/ajax-loader.gif" />			
		<div class="controls"><a href="#" class="request_bt">שלח בקשה</a></div>
	</div>
	</body>
</html>
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
	var captch = '<?php echo $this->session->userdata('word') ?>';
	$('.request_bt').click(function(){
		var excludes = [];
		url = '<?php echo base_url();?>' + 'user/submitfreindrequest';
		var requester = '<?php echo $requester[0]->user_id ?>';
		var requestfrom = '<?php echo $user[0]->user_id; ?>';
		var requestMessage = $('.requester_text textarea').val();
		if($('#captchField').val() == captch || $('#captchField').val() == captch.toLowerCase()){
		$.ajax({  
				type: "POST",  
				url: url,  
				data:  {requesterId: requester , requestfrom: requestfrom , requestMessage: requestMessage},
				beforeSend: function() {
					$("#sending").show();
					$('#error_message').html('שולח בקשה');
				},				
				success: function(res) {
						$("#sending").hide();
						$('.notif').addClass('success');
						$('#error_message').html('הבקשה נשלחה בהצלחה');
						window.setInterval(function() {parent.jQuery.fancybox.close();}, 2000);
					}
			});	
		} else {
		$.ajax({  
				type: "POST",  
				dataType: 'json',
				url: '<?php echo base_url();?>' + 'user/generatecaptcha',
				beforeSend: function() {
					$("#sending").show();
					$('#error_message').html('בודק בקשה');
				},	
				success: function(json) {					
					captch = json.word;
					$('#error_message').html('קוד האימות שגוי , נסה שנית');
					$("#sending").hide();
					$('.captcha').html(json.image);
				}
			});	
		}
	});

	
	// Remove search bar text on foucos
	var Input = $('input[name=captcha]');
	var default_value = Input.val();
	Input.focus(function() {
		if(Input.val() == default_value) Input.val("");
	}).blur(function(){
		// $('#divResult').hide();
		if(Input.val().length == 0) Input.val(default_value);
	});	
	
});
		
		
</script>