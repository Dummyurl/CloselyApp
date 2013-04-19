<div class="store_nav">
	<ul class="store_buttons">
		<li id="storeinfo" rel="1"><div class="button_text ">פרטי העסק</div></li>
		<li id="freindsshop" rel="2"><div class="button_text">קנו כאן</div></li>
		<li id="storecoupons" rel="3"><div class="button_text">קופונים</div></li>
		<li id="storesales" rel="4"><div class="button_text">מבצעים</div></li>
		<li id="storeproducts"rel="5"><div class="button_text">מוצרים</div></li>
		<li id="storerecommands" rel="6"><div class="button_text">המלצות</div></li>		
	</ul>
<div class="store_logo"><img src="<?php echo base_url();?>asset/img/bizlogos/<?php echo $info->store_logo;?>"  /></div>
<div class="select_bar">פרטי העסק</div>
</div>
<div class="store_tab_page">
		<?php $this->load->view('page/store/storeinfo'); ?>
</div>

<script type="text/javascript" charset="utf-8">
$(document).ready(function(){	
$(".select_bar").css("right",322);
	$('.store_buttons li').click(function(){
/* 	$('.store_buttons li').each(function(){
		$(this).removeClass('select_bar');
	}); */
	// $(this).addClass('select_bar');
	var position = $(this).position();
	
	var level = $(this).attr('rel');
	$(".select_bar").css("right",239+level*83);
	$(".select_bar").text($(this).text());
		var tab = $(this).attr('id');
		url = '<?php echo base_url();?>' + 'store/gettab';
		
		$.ajax({  
				type: "POST",  
				url: url,  
				data:  'tab=' + tab + '&store=' + '<?php echo $store ?>',
				beforeSend: function() {
					// $("#loading-feed").show();
				},				
				success: function(block) {
					// $("#loading-feed").hide();
					 $('.store_tab_page').html(block);
					 
					}
					 
				});		
	});
}); 
</script>