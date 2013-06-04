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
		<div class="request_row"><span>הקופון המבוקש</span><?php echo $coupon[0]->coupon_name; ?></div>
		<div class="request_content">
			<div class="requester_image"><img src="https://graph.facebook.com/<?php echo $coupon[0]->user_id; ?>/picture?type=large"  /></div>
			<div class="requester_text"><textarea>היי , אני מעוניין בקופון הזה ,אשמח אם תוכל לאשר לי את בקשתי</textarea></div>
		</div>
		<div class="offer_row">
		<div class="select_text">בחר קופונים שאינך מעוניין להחליף תמורת קופון זה</div>
			<div>
			<select data-placeholder="בחר קוופון" multiple class="chzn-select chzn-rtl" style="width:350px;" tabindex="18" id="multiple-label-example">
			  <option value=""></option>
			  <option>American Black Bear</option>
			  <option>Asiatic Black Bear</option>
			  <option>Brown Bear</option>
			  <option>Sloth Bear</option>
			  <option>Sun Bear</option>
			  <option>Polar Bear</option>
			  <option>Spectacled Bear</option>
			</select>
		  </div>
	  </div>
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
	
});
		
</script>