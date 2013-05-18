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
			</div>
			
			<div class="product_stores">
				<div class="header">עסקים המשווקים את  המוצר</div>
				<div class="triangle"></div>
				<?php foreach ($stores as $store) : ?>
					<?php $storeInfo = $this->catalog_model->getStoreInfo($store->store_id) ?>
				<?php endforeach ?>
			</div>


		</div>
		<div class="middle_content">
			<div class="product_buyers">
			<div class="header">קנו את המוצר</div>
			<div class="triangle"></div>
			<?php foreach ($buyers as $buyer) : ?>
			
			<?php endforeach ?>
			</div>
			<div class="adv">
			</div>
		</div>
		<div id="loadind_tab"><img src="<?php echo base_url();?>asset/img/ajax-loader.gif" /></br>טוען עמוד</div>
		<div class="actions_grid">
			<div class="store_block_header">המלצות</div>
			<div class="triangle"></div>
			<?php /* $this->load->view('blocks/shops',$last_shops); */ ?>
		</div>
	</div>
</div>	
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){	

 }); 
</script>
