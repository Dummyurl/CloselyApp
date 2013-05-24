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
					<div class="store_logo_hr">עסק</div>
					<div class="store_address_hr">פרטי העסק</div>
					<div class="store_times_hr">מחיר</div>
					<div class="store_rate_hr">דירוג</div>

				</div>
				<ul class="stores_list">
					<?php foreach ($stores as $store) : ?>
						<?php $storeInfo = $this->catalog_model->getStoreInfo($store->store_id) ?>
						<li class="store_line">
							<div class="store_logo"><a href="<?php echo base_url();?>store/popup/<?php echo $storeInfo[0]->store_id ?>" class = "fancybox"><img class="biz_logo" src="<?php echo base_url() . 'asset/img/bizlogos/' . $storeInfo[0]->store_logo  ?> "/></a></div>
							<div class="store_address">פרטים</div>
							<div class="store_times"><?php echo '₪' .  $store->price ?></div>
							<div class="store_rate"><img src="<?php echo base_url() . 'asset/img/handrating_full.png'  ?> "/></div>
						</li>
					<?php endforeach ?>
				</ul>
			</div>


		</div>
		
		<div class="middle_content">
			<div class="product_details">
				<div class="header">פרטי המוצר</div>
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
 }); 
</script>
