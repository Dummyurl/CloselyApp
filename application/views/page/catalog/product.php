<?php $this->load->helper('url'); ?>
<div class="product_page_container">
	<div class="left_title">
		<h1><?php echo $info->product_name; ?></h1>
		<div class="add_recommand">הוסף המלצה<img src="<?php echo base_url();?>asset/img/add.png" /></div>
	</div>	
	<div class="content">
		<div class="top_content">
		
			<div class="image_box">
				<img src="<?php echo base_url();?>asset/img/store/<?php echo $info->store_id .'/'. $info->product_image ?>"/>
				<?php if($info->price) : ?>
					<div class="product_price"><?php echo '₪' . $info->price ?></div>
				<?php endif ?>
			</div>
			
			<div class="product_stores">
				<div class="header">עסקים המשווקים את  המוצר</div>
				<div class="triangle"></div>
				<div class="store_header">
					<div class="store_logo_hr tb_title" id="store_id">עסק</div>
					<div class="store_address_hr" id="biz_details">פרטי העסק</div>
					<div class="store_times_hr tb_title" id="price">מחיר</div>
					<div class="store_rate_hr tb_title" id="rating">דירוג</div>

				</div>
				<ul class="stores_list">
					<?php foreach ($stores as $key=>$store) : ?>
						<?php $storeInfo = $this->catalog_model->getStoreInfo($store['store_id']) ?>
						<?php $rating = $this->stores_model->getStoreRating($store['store_id']) ?>
						<?php $stores[$key]['rating'] = $rating ?>
						<?php $stores[$key]['logo'] = $storeInfo[0]->store_logo ?>
						<li class="store_line">
							<div class="store_logo"><a href="<?php echo base_url();?>store/popup/<?php echo $storeInfo[0]->store_id ?>" class = "fancybox"><img class="biz_logo" src="<?php echo base_url() . 'asset/img/bizlogos/' . $storeInfo[0]->store_logo  ?> "/></a></div>
							<div class="store_address">פרטים</div>
							<div class="store_times"><?php echo '₪' .  $store['price'] ?></div>
							<div class="store_rate"><div class="rateit" data-rateit-readonly="true" <?php echo 'data-rateit-value="' . $rating . '" data-rateit-ispreset="true"' ?>></div></div>
							<div class="rate_score"><?php echo $rating ?></div>
						</li>
					<?php endforeach ?>
				</ul>
			</div>


		</div>
		
		<div class="middle_content">
			<div class="product_details">
				<div class="header">
					<div class= "product_headtext">פרטי המוצר</div>
					<div class= "product_ratig">
					<?php if ($iBuyThisProduct['buy']) : ?>
						<?php if ($iRateThisProduct['exist']) : ?>
							<div class="rating_messaege product_rate"><?php echo 'דירגת כבר חנות זו' ?></div>
							<div class="store_rating"><div data-storeid="<?php echo $info->store_id;?>"  data-productid="<?php echo $info->product_id;?>" class="rateit" data-rateit-readonly="true" <?php echo 'data-rateit-value="' . $totalRating . '" data-rateit-ispreset="true"' ?>></div></div>
							<div class="raters"><?php echo '(' .  $raters . ' מדרגים )' ?></div>
							<?php else : ?>
							<div class="rating_messaege product_rate"><?php echo $iBuyThisProduct['message'] ?></div>
							<div class="store_rating"><div data-storeid="<?php echo $info->store_id;?>"  data-productid="<?php echo $info->product_id;?>" class="rateit" <?php /* echo !empty($iRateThisStore) ?  'data-rateit-value="' . $iRateThisStore . '" data-rateit-ispreset="true" data-rateit-readonly="true"' : '' ; */ ?>></div></div>
							<div class="raters"><?php echo '(' .  $raters . ' מדרגים )' ?></div>
							<?php endif ?>
						<?php else : ?>
						<div class="rating_messaege product_rate"><?php echo $iBuyThisProduct['message'] ?></div>
						<div class="store_rating"><div data-storeid="<?php echo $info->store_id;?>" data-productid="<?php echo $info->product_id;?>"  class="rateit" data-rateit-readonly="true" <?php echo 'data-rateit-value="' . $totalRating . '" data-rateit-ispreset="true"' ?>></div></div>
						<div class="raters"><?php echo '(' .  $raters . ' מדרגים )' ?></div>
					<?php endif ?>
					</div>
			</div>
				
				<div class="triangle"></div>
				<div class="description"><?php echo $info->description ?></div>
			</div>
			<div class="product_buyers">
				<div class="header">קנו את המוצר</div>
				<div class="triangle"></div>
				<ul class="buyers_list">
				<?php foreach ($buyers as $buyer) : ?>
					<li class="buyer"><a href="<?php echo base_url();?>user/popup/<?php echo $buyer ?>" class="fancybox"><img src="https://graph.facebook.com/<?php echo $buyer ?>/picture"/></a></li>
				<?php endforeach ?>
				</ul>
			</div>
			<div class="adv">
			</div>
		</div>
		<div id="loadind_tab"><img src="<?php echo base_url();?>asset/img/ajax-loader.gif" /></br>טוען עמוד</div>
		<div class="prd_rec">
			<div class="comments">
				<?php $this->load->view('blocks/product_comments_template',$blocks); ?>
			</div>
		</div>
	</div>
</div>	
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){	
	$(function(){$('.stores_list').jScrollPane();});
	
	$('.store_rating .rateit').bind('rated reset', function (e) {
		var ri = $(this);

		//if the use pressed reset, it will get value: 0 (to be compatible with the HTML range control), we could check if e.type == 'reset', and then set the value to  null .
		var value = ri.rateit('value');
		var storeID = ri.data('storeid'); // if the product id was in some hidden field: ri.closest('li').find('input[name="productid"]').val()
		var productID = ri.data('productid'); // if the product id was in some hidden field: ri.closest('li').find('input[name="productid"]').val()
		var userID = '<?php echo $userId ?>';
		//maybe we want to disable voting?
		ri.rateit('readonly', true);
		var rateUrl = '<?php echo base_url();?>' + 'product/rateproduct';
		$.ajax({
			url: rateUrl, //your server side script
			data: { store: storeID, rating: value , product: productID ,user: userID }, //our data
			type: 'POST',
			success: function (data) {
				$('#response').append('<li>' + data + '</li>');

			},
			error: function (jxhr, msg, err) {
				$('#response').append('<li style="color:red">' + msg + '</li>');
			}
		});
	});

	var order = 'desc';
	$('.tb_title').click(function(){
	var url = '<?php echo base_url();?>' + 'product/sortStores';
	var field = $(this).attr('id');
		$.ajax({  
				type: "POST",  
				url: url, 
				data:   { data: '<?php echo json_encode($stores) ?>', order: order , attribute: field},
				beforeSend: function() {
					// $("#load_store_tab").show();
				},				success: function(block) {
					$('.stores_list .jspPane').html(block);
					 $(function(){$('.stores_list').jScrollPane();});
					 if (order == 'desc'){
						order = 'asc';
					} else {
						order = 'desc';
					}
					// $("#load_store_tab").hide();
					 
					}
					 
				});		
	});
	
	
 }); 
</script>
