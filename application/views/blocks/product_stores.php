<script type="text/javascript" src="<?php echo base_url();?>asset/js/jquery.rateit.js"></script>	
<?php foreach ($stores as $store) : ?>
	<li class="store_line">
		<div class="store_logo"><a href="<?php echo base_url();?>store/popup/<?php echo $store['store_id'] ?>" class = "fancybox"><img class="biz_logo" src="<?php echo base_url() . 'asset/img/bizlogos/' . $store['logo']  ?> "/></a></div>
		<div class="store_address">פרטים</div>
		<div class="store_times"><?php echo '₪' .  $store['price'] ?></div>
		<div class="store_rate"><div class="rateit" data-rateit-readonly="true" <?php echo 'data-rateit-value="' . $store['rating'] . '" data-rateit-ispreset="true"' ?>></div></div>
	</li>
<?php endforeach ?>

