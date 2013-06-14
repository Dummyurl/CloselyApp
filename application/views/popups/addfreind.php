<?php $this->load->helper('url'); ?>	
<!doctype html>
<html class="no-js">	
	<head>
		<?php $this->load->view('head/meta'); ?>
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
		
		<div class="controls"><a href="#" class="request_bt">שלח בקשה</a></div>
	</body>
</html>
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
	$('.request_bt').click(function(){
		var excludes = [];
		url = '<?php echo base_url();?>' + 'user/submitfreindrequest';
		var requester = '<?php echo $requester[0]->user_id ?>';
		var requestfrom = '<?php echo $user[0]->user_id; ?>';
		var requestMessage = $('.requester_text textarea').val();
		
		$.ajax({  
				type: "POST",  
				url: url,  
				data:  {requesterId: requester , requestfrom: requestfrom , requestMessage: requestMessage},				
				success: function(res) {
				 
					}
			});		
	});

});
		
		
</script>