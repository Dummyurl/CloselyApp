<?php $this->load->helper('url'); ?>
<div class="wall-messages">	
<div class="block_title_container">
	<div class="double_grey_single_divider"></div>	
	<div class="block_title">...קניות אחרונות</div>
	<div class="double_grey_double_divider"></div>
	<div class="triangle_blocks "></div>
</div>	
	<ul class="list_container">
		<?php foreach ($last_shops as $shop) : ?>
		<?php $storeInfo = $this->catalog_model->getStoreInfo($shop->store_id) ?>
		<?php $shopProducts = $this->catalog_model->getShopProducts($shop->products) ?>
		<?php $userInfo = $this->catalog_model->getUserInfo	($shop->user_id) ?>
		<li class="listGrid">
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

					<ul class="bxslider2">
						<?php foreach ($shopProducts as $product) : ?>
							<li><img class="shop-photo" src="<?php echo base_url();?>asset/img/store/<?php echo $product->store_id .'/'. $product->product_image ?>"/></li>
						<?php endforeach ?>
					</ul>
					</div>
				</div>
				<div class="shop_footer">
<div class="triangle-up"></div>
<div class="shop_title"><?php echo $shop->shop_title ?></div>
<div class="stars-rate"></div>
<div class="clearfix"></div>
<div class="brandlogo"><a href="<?php echo base_url();?>store/popup/<?php echo $storeInfo[0]->store_id ?>" class = "fancybox"><img class="biz_logo" src="<?php echo base_url() . 'asset/img/bizlogos/' . $storeInfo[0]->store_logo  ?> "/></a></div>
<div class="shop_detials"><a href="/shops/popup/<?php echo $shop->shop_id ?>" class="fancybox">פרטי הקנייה</a></div>
				</div>
			</div>	
			
		</li>
	<?php endforeach ?>
	<div class = "more_result"></div>
	
	</ul>
</div>




<script type="text/javascript">
	$(document).ready(function(){	
		 $('.bxslider2').bxSlider();	
		$('.product_grid').hoverIntent(overimg,outimg);
		 function overimg(){ $(this).children('.over-img-photo').css('display','block')}
		 function outimg(){ $(this).children('.over-img-photo').css('display','none')}
		
	});
</script>

 <script type="text/javascript">
            var page = 1;
			function loading() { /* $('#more').hide(); */ }
			
			

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

                    var actual_count = "<?php echo $last_shops_cnt; ?>";

                    if((page-1)* 9 > actual_count){
					 
                      //  $('#no-more').css("top","400");
                      //  $('#no-more').show();
                    }else{
					url = '<?php echo base_url();?>' + 'shops/index/' + page;
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