<?php $this->load->helper('url'); ?>
<?php $this->load->view('head/multilocation',$branches); ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=he&libraries=places"></script>		
<div class="store_add_buttons">
<?php if ($iBuyInStore['buy']) : ?>
		<?php if ($iRateThisStore['exist']) : ?>
		<div class="store_rating"><div data-storeid="<?php echo $info->store_id;?>"  class="rateit" data-rateit-readonly="true" <?php echo 'data-rateit-value="' . $totalRating . '" data-rateit-ispreset="true"' ?>></div></div>
		<div class="raters"><?php echo '(' .  $raters . ' מדרגים )' ?></div>
		<div class="rating_messaege"><?php echo 'דירגת כבר חנות זו' ?></div>
		<?php else : ?>
		<div class="store_rating"><div data-storeid="<?php echo $info->store_id;?>"  class="rateit" <?php echo 'data-rateit-value="' . $totalRating . '" data-rateit-ispreset="true"' ?>></div></div>
		<div class="raters"><?php echo '(' .  $raters . ' מדרגים )' ?></div>
		<div class="rating_messaege"><?php echo $iBuyInStore['message'] ?></div>
		<?php endif ?>
	<?php else : ?>
	<div class="store_rating"><div data-storeid="<?php echo $info->store_id;?>"  class="rateit" data-rateit-readonly="true" <?php echo 'data-rateit-value="' . $totalRating . '" data-rateit-ispreset="true"' ?>></div></div>
	<div class="raters"><?php echo '(' .  $raters . ' מדרגים )' ?></div>
	<div class="rating_messaege"><?php echo $iBuyInStore['message'] ?></div>
<?php endif ?>

	<div class="store_add">הוסף המלצה<img src="<?php echo base_url();?>asset/img/add.png" /></div>
	<div class="store_add">הוסף קנייה<img src="<?php echo base_url();?>asset/img/add.png" /></div>
</div>

<div class="store_wall_image">
<div class="headline"><?php echo $info->store_name;?></div>
<div class="imageline"><img src="<?php echo base_url();?>asset/img/bizlogos/<?php echo $info->store_logo;?>" class="headimage"  /></div>
<img src="<?php echo base_url();?>asset/img/bizwalls/<?php echo $info->wall_image;?>"  /></div>
<div class="store_nav">
	<ul class="store_buttons">
		<li id="storeinfo" rel="1"><div class="button_text ">פרטי העסק</div></li>
		<li id="freindsshop" rel="2"><div class="button_text">?מי קנה פה</div></li>
		<li id="storecoupons" rel="3"><div class="button_text">קופונים</div></li>
		<li id="storesales" rel="4"><div class="button_text">מבצעים</div></li>
		<li id="storeproducts"rel="5"><div class="button_text">מוצרים</div></li>
		<li id="storerecommands" rel="6"><div class="button_text">המלצות</div></li>		
	</ul>
<div class="store_summery">
	<img src="<?php echo base_url();?>asset/img/useractioncount.png" />
	<div class="freind_cnt"><div class="cnt_bubble popup_bubble header_red store_bubble" id="coupons"><?php echo $couponsCnt;?></div></div>
	<div class="freind_cnt"><div class="cnt_bubble popup_bubble header_red store_bubble" id="shops"><?php echo $shopsCnt;?></div></div>
	<div class="freind_cnt"><div class="cnt_bubble popup_bubble header_red store_bubble" id="recommands"><?php echo $recommandsCnt;?></div></div>		
</div>
<div class="select_bar">פרטי העסק</div>
</div>
<div id ="load_store_tab" ><img src="<?php echo base_url();?>asset/img/ajax-loader.gif" /></br>טוען עמוד</div>
<div class="store_tab_page">
		<?php $this->load->view('page/store/storeinfo',$store); ?>
</div>

<?php $freinds = json_encode($freinds) ?>

<script type="text/javascript" charset="utf-8">
$(document).ready(function(){	

	//we bind only to the rateit controls within the products div
	$('.store_rating .rateit').bind('rated reset', function (e) {
		var ri = $(this);

		//if the use pressed reset, it will get value: 0 (to be compatible with the HTML range control), we could check if e.type == 'reset', and then set the value to  null .
		var value = ri.rateit('value');
		var storeID = ri.data('storeid'); // if the product id was in some hidden field: ri.closest('li').find('input[name="productid"]').val()

		//maybe we want to disable voting?
		ri.rateit('readonly', true);
		var rateUrl = '<?php echo base_url();?>' + 'store/ratestore';
		$.ajax({
			url: rateUrl, //your server side script
			data: { store: storeID, rating: value , user: '<?php echo $userId ?>'}, //our data
			type: 'POST',
			success: function (data) {
				$('#response').append('<li>' + data + '</li>');

			},
			error: function (jxhr, msg, err) {
				$('#response').append('<li style="color:red">' + msg + '</li>');
			}
		});
	});





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
				data:  'tab=' + tab + '&store=' + '<?php echo $id ?>' + '&loggin=' + '<?php echo $isloggin ?>' + '&freinds=<?php echo $freinds ?>',
				beforeSend: function() {
					$("#load_store_tab").show();
				},				success: function(block) {
				console.log('sdfsd');
					// $("#loading-feed").hide();
					 $('.store_tab_page').html(block);
					 $("#load_store_tab").hide();
					 
					}
					 
				});		
	});
	
		
	



}); 
</script>