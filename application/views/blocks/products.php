<?php $this->load->helper('url'); ?>

<div class="wall-messages">	
	<ul class="list_container">
		<?php $j = 0; ?>
		<?php foreach ($products as $product) : ?>
		<?php $storeInfo = $this->catalog_model->getStoreInfo($product->store_id) ?>
		<?php $rating = $this->catalog_model->getProductRating($product->store_id,$product->product_id) ?>
		<li class="listGrid">
			<div class="product_grid">
				<div class="shop_header">
				<img src="https://graph.facebook.com/<?php echo $shop->user_id ?>/picture"/>
				<div class="triangle"></div>
				</div>
				<div class="shop_contant">
					<div class="clearfix"></div>
					<div class="shop_image">
						<img class="shop-photo" src="<?php echo base_url();?>asset/img/store/<?php echo $product->store_id . '/' . $product->product_image  ?>"/>   
					<?php endif ?>
					</div>
				</div>
				<div class="shop_footer">
					<div class="addon_icons">
						<ul>
						<?php if (!empty($product->price)) : ?>
						<li><img src="<?php echo base_url();?>asset/img/fav.png"/></li>
						<?php endif ?>
						</ul>
					</div>
					<div class="triangle-up"></div>
					<div class="shop_title"><?php echo $product->product_name  ?></span></div>
					<div class="product_rating"><div data-storeid="<?php echo $info->store_id;?>" data-storeid="<?php echo $product->store_id ?>"  class="rateit" data-rateit-readonly="true" <?php echo 'data-rateit-value="' . $$rating . '" data-rateit-ispreset="true"' ?>></div></div>
					<div class="clearfix"></div>
					<div class="brandlogo"><a href="<?php echo base_url();?>store/popup/<?php echo $storeInfo[0]->store_id ?>" class = "fancybox"><img class="biz_logo" src="<?php echo base_url() . 'asset/img/bizlogos/' . $storeInfo[0]->store_logo  ?> "/></a></div>
					<div class="shop_detials"><a href="/catalog/product/<?php echo $product->url_key ?>">עמוד המוצר</a></div>
				</div>
			</div>	
			
		</li>
	<?php endforeach ?>
	<div class = "more_result"></div>
	
</ul>

</div>

 <script type="text/javascript">
            var page = 1;
			function loading() { /* $('#more').hide(); */ }
			
			//we bind only to the rateit controls within the products div
			$('.product_rating .rateit').bind('rated reset', function (e) {
				var ri = $(this);

				//if the use pressed reset, it will get value: 0 (to be compatible with the HTML range control), we could check if e.type == 'reset', and then set the value to  null .
				var value = ri.rateit('value');
				var productID = ri.data('productid'); // if the product id was in some hidden field: ri.closest('li').find('input[name="productid"]').val()
				var storeID = ri.data('storeid');
				//maybe we want to disable voting?
				ri.rateit('readonly', true);
				var rateUrl = '<?php echo base_url();?>' + 'product/rateproduct';
				$.ajax({
					url: rateUrl, //your server side script
					data: { product: productID, rating: value , store: storeID }, //our data
					type: 'POST',
					success: function (data) {
						$('#response').append('<li>' + data + '</li>');

					},
					error: function (jxhr, msg, err) {
						$('#response').append('<li style="color:red">' + msg + '</li>');
					}
				});
			});

            $(window).scroll(function () {
               // $('#more').hide();
              //  $('#no-more').hide();
			  console.log($(window).scrollTop() + $(window).height());

                if($(window).scrollTop() + $(window).height() > $(document).height() - 600) {
					
                  //  $('#more').show();
                }
				
				var scrolling = $(window).scrollTop() + $(window).height();
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
					url = '<?php echo base_url();?>' + 'productss/index/' + page;
                        $.ajax({
                            type: "POST",
                            url: url,
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

        </script>