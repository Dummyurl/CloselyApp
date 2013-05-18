<?php $this->load->helper('url'); ?>
		<?php foreach ($products as $product) : ?>
		<?php $storeInfo = $this->catalog_model->getStoreInfo($product->store_id) ?>
		<li class="listGrid products">
				<div class="product_grid">
					<div class="shop_header product_header">
			<?php	/* 	<a href="<?php echo base_url();?>store/popup/<?php echo $storeInfo[0]->store_id ?>" class = "fancybox"><img class="product_store_logo" src="<?php echo base_url() . 'asset/img/bizlogos/' . $storeInfo[0]->store_logo  ?> "/></a> */ ?>
			<?php	/* <div class="my_barcode"><?php echo $product->product_id ?></div> */ ?>
					</div>
				</div>
				<div class="shop_contant">
					<div class="clearfix"></div>
					<div class="product_grid_title"><p class="title_text"><?php echo $product->product_name  ?></p></div>
					<div class="shop_image">
						<img class="product-photo" src="<?php echo base_url();?>asset/img/store/<?php echo $product->store_id . '/' . $product->product_image  ?>"/>   
					</div>
					<?php if($product->price) : ?>
						<div class="product_price"><?php echo '₪' . $product->price ?></div>
					<?php endif ?>
				</div>
				<div class="shop_footer">
					<div class="triangle-up"></div>
					<div class="stars-rate">
					<img class="rating" src="<?php echo base_url();?>asset/img/star.png" />
					<div class="raters">5 דירוגים</div>
					</div>
					<div class="clearfix"></div>
					<div class="brandlogo"><a href="<?php echo base_url();?>store/popup/<?php echo $storeInfo[0]->store_id ?>" class = "fancybox"><img class="biz_logo" src="<?php echo base_url() . 'asset/img/bizlogos/' . $storeInfo[0]->store_logo  ?> "/></a></div>
					<div class="shop_detials"><a href="/catalog/product/<?php echo $storeInfo[0]->url_key . '/' . $product->url_key ?>">עמוד המוצר</a></div>
				</div>
		</li>
	<?php endforeach ?>

	
