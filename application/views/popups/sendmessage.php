<?php $this->load->helper('url'); ?>	
<!doctype html>
<html class="no-js">	
	<head>
		<?php $this->load->view('head/meta'); ?>
		<?php $this->load->view('head/css'); ?>
		<script src="<?php echo base_url();?>asset/js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>asset/js/chosen.jquery.js"></script>
	</head>	
	<body>
	<div class="popup">
		<div class="head_title qrpb"><span>שליחת הודעה</span></div>
		<div class="request_row"><span class="coupon_name"><?php echo $user[0]->user_name; ?></span><span>שלח הודעה ל</span></div>
		<div class="request_content">
			<div class="requester_image"><img src="https://graph.facebook.com/<?php echo $user[0]->user_id; ?>/picture?type=large"  /></div>
			<div class="requester_text"><textarea>הזן כאן את תוכן ההודעה</textarea></div>
		</div>
		<div id="error_message" class="notif"></div>	
		<img id="sending" src="<?php echo base_url();?>asset/img/ajax-loader.gif" />			
		<div class="controls"><a href="#" class="request_bt">שלח בקשה</a></div>
	</body>
</html>
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
	$('.request_bt').click(function(){
		url = '<?php echo base_url();?>' + 'user/postusermessage';
		var sender = '<?php echo $sender[0]->user_id ?>';
		var recipt = '<?php echo $user[0]->user_id; ?>';
		var message = $('.requester_text textarea').val();
		
		$.ajax({  
				type: "POST",  
				url: url,  
				data:  {senderId: sender , recipt: recipt , message: message},				
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
	});

});	
</script>