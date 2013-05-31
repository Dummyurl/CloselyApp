<?php $this->load->helper('url'); ?>
<script type="text/javascript" src="<?php echo base_url();?>asset/js/jquery.rateit.js"></script>	
<div class="wall-messages">	
	<ul class="list_container">
		<?php foreach ($products as $product) : ?>
		<?php $storeInfo = $this->catalog_model->getStoreInfo($product->store_id) ?>
		<?php $rating = $this->catalog_model->getProductRating($product->store_id,$product->product_id) ?>
		<?php $raters = $this->catalog_model->getRatersNum($product->store_id,$product->product_id) ?>

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
					<div class="product_rating"><div  class="rateit" data-rateit-readonly="true" <?php echo 'data-rateit-value="' . $rating . '" data-rateit-ispreset="true"' ?>></div></div>
					<div class="raters"><?php echo $raters . ' מדרגים ' ?></div>
					</div>
					<div class="clearfix"></div>
					<div class="brandlogo"><a href="<?php echo base_url();?>store/popup/<?php echo $storeInfo[0]->store_id ?>" class = "fancybox"><img class="biz_logo" src="<?php echo base_url() . 'asset/img/bizlogos/' . $storeInfo[0]->store_logo  ?> "/></a></div>
					<div class="shop_detials"><a href="/catalog/product/<?php echo $product->url_key ?>">עמוד המוצר</a></div>
				</div>
		</li>
	<?php endforeach ?>
	<div class = "more_result"></div>
	
</ul>

</div>

 <script type="text/javascript">
$(document).ready(function(){	
            var page = 1;
			function loading() { /* $('#more').hide(); */ }
			
            $(window).scroll(function () {
               // $('#more').hide();
              //  $('#no-more').hide();
			//  console.log($(window).scrollTop() + $(window).height());

                if($(window).scrollTop() + $(window).height() > $(document).height() - 600) {
					
                  //  $('#more').show();
                }
				
				var scrolling = $(window).scrollTop() + $(window).height();
				console.log(winh - scrolling);
				var winh = $(document).height();
                if((winh - scrolling)<600) {
                  //  $('#more').show();
					window.setInterval(loading, 2000);
                  //  $('#no-more').hide();

                    page++;

                    var actual_count = "<?php echo $products_cnt; ?>";

                    if((page-1)* 9 > actual_count){
					 
                      //  $('#no-more').css("top","400");
                      //  $('#no-more').show();
                    }else{
					url = '<?php echo base_url();?>' + 'products/category/' + page;
                        $.ajax({
                            type: "POST",
                            url: url,
							data:'&categoryId=' + '<?php echo $categoryId ?>',
							beforeSend:  function(){
								$("#loading").show();
								setTimeout(function(){getNewUpdates();}, 58000);
							},
                            success: function(res) {
							setTimeout(function(){
								$(".more_result").append($(res).fadeIn('slow'));
								$("#loading").hide();
							}, 1500);
										
                            }
                        });
                    }

                }


            });
});
        </script>