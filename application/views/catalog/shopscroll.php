<?php $this->load->helper('url'); ?>
		<?php foreach ($shops as $shop) : ?>
		<?php $storeInfo = $this->catalog_model->getStoreInfo($shop->store_id) ?>
		<?php $userInfo = $this->catalog_model->getUserInfo	($shop->user_id) ?>
		<li>
			<div class="product_grid">
			<div class="over-img-photo">
				<p class="shop_adder"><?php echo $userInfo[0]->user_name  . '<span class = "subject"> :שם הקונה </span>'?></p>
				<p class="shop_adder"><?php echo $shop->shop_time  . '<span class = "subject"> :תאריך הקנייה </span>'?></p>
				<p class="shop_adder"><span class = "subject">פרטי הקנייה</span></p>
				<?php if (!empty($shop->shop_description)) : ?>
				<p class="shop_adder"><?php echo $shop->shop_description ?></p>
				<?php endif ?>
				<?php if (!empty($shop->shop_price)) : ?>
				<p class="shop_adder"><?php echo $shop->shop_price  . '<span class = "subject"> :מחיר </span>' ?></p>
				<?php endif ?>
				<p class="shop_adder"><?php echo '66'  . '<span class = "subject"> :שיתפו בעסק זה </span>' ?></p>
				<p class="shop_adder"><?php echo '5 כוגבים'  . '<span class = "subject"> :דירוג העסק </span>' ?></p>
			</div>
				<div class="shop_header">
				<img src="https://graph.facebook.com/<?php echo $shop->user_id ?>/picture"/>
				<div class="my_barcode">665111543</div>
				<div class="triangle"></div>
				</div>
				<div class="shop_contant">
					<div class="clearfix"></div>
					<div class="shop_image">
						<div class="addon_icons">
							<ul>
							<li><img src="<?php echo base_url();?>asset/img/fav.png"/></li>
							<li><img src="<?php echo base_url();?>asset/img/comments.png"/></li>
							<li><img src="<?php echo base_url();?>asset/img/price.png"/></li>
							</ul>
						</div>
						<img class="shop-photo" src="<?php echo base_url();?>asset/img/shops/<?php echo $shop->shop_image ?>"/>
					</div>
				</div>
				<div class="shop_footer">
				<div class="triangle-up"></div>
				<div class="shop_title"><?php echo $shop->shop_title ?></div>
				<div class="stars-rate"></div>
				<div class="clearfix"></div>
				<div class="brandlogo"><img class="biz_logo" src="<?php echo base_url() . 'asset/img/bizlogos/' . $storeInfo[0]->store_logo  ?> "/></div>
				<div class="shop_detials" >פרטי הקנייה</div>
				</div>
			</div>			
		</li>
		<?php endforeach ?>
