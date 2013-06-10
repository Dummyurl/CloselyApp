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
		<div class="head_title qrpb"><span>בקשת קופון</span></div>
		<div class="request_row"><span>הקופון המבוקש</span><span class="coupon_name"><?php echo $coupon[0]->coupon_name; ?></span></div>
		<div class="request_content">
			<div class="requester_image"><img src="https://graph.facebook.com/<?php echo $coupon[0]->user_id; ?>/picture?type=large"  /></div>
			<div class="requester_text"><textarea>היי , אני מעוניין בקופון הזה ,אשמח אם תוכל לאשר לי את בקשתי</textarea></div>
		</div>
		<?php if ($couponList) : ?>
		<div class="offer_row">
		<div class="select_text">בחר קופונים שאינך מעוניין להחליף תמורת קופון זה</div>
			<div>
			<select data-placeholder="בחר קוופון" multiple class="chzn-select chzn-rtl"  tabindex="18" id="multiple-label-example">
			  
			  <option value=""></option>
			  <?php foreach($couponList as $couponName): ?>
				<option value="<?php echo $couponName->coupon_id ?>"><?php echo $couponName->coupon_name ?></option>
			  <?php endforeach; ?>
			</select>
		  </div>
	  </div>
	  <?php endif ?>
		<div class="controls"><a href="#" class="request_bt">שלח בקשה</a></div>
	</body>
</html>
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
	// $('.requester_text textarea').height($('.requester_image').height());
	var config = {
      '.chzn-select'           : {},
      '.chzn-select-deselect'  : {allow_single_deselect:true},
      '.chzn-select-no-single' : {disable_search_threshold:4},
      '.chzn-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chzn-select-width'     : {width:"100%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
	$('.chzn-container').css('width','100%')

	$('.request_bt').click(function(){
		var excludes = [];
		url = '<?php echo base_url();?>' + 'catalog/submitcouponrequest';
		$('.search-choice span').each(function() {
			excludes.push($(this).text());
		});
		excludes = excludes.toString();
		var requester = '<?php echo $user ?>';
		var requestfrom = '<?php echo $coupon[0]->user_id; ?>';
		var couponId = '<?php echo $coupon[0]->coupon_id; ?>';
		var requestMessage = $('.requester_text textarea').val();
		
		$.ajax({  
				type: "POST",  
				url: url,  
				data:  {requesterId: requester , requestfrom: requestfrom , couponId: couponId , requestMessage: requestMessage , excludes: excludes},				
				success: function(res) {
				 
					}
			});		
	});
/* 		$.ajax({  
				type: "POST",  
				url: url,  
				data:  {requesterId: requester , requestfrom: requestfrom , couponId: couponId , requestMessage: requestMessage},				
				success: function(res) {
				var product = res; 
				console.log(product.description);
					 $(".description").html(product.description);
					 $(".product_details .header").html(product.product_name); 
					 if(product.price != 0){
						$(".product_price").show();
						$(".product_price").html('₪' + product.price); 
					 } else {
						$(".product_price").hide();
					 }
					 
					}
					 
				});	 */	
	

	
});
		
</script>