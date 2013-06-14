<?php $this->load->helper('url'); ?>
<div class="wall-messages">	
<div class="block_title_container">
	<div class="double_grey_single_divider"></div>	
	<div class="block_title">...קניות אחרונות</div>
	<div class="double_grey_double_divider"></div>
	<div class="triangle_blocks "></div>
</div>	
	<ul class="list_container">
		<?php $j = 0; ?>
		<?php foreach ($last_shops as $shop) : ?>
		<?php $j++ ?>
		<?php $storeInfo = $this->catalog_model->getStoreInfo($shop->store_id) ?>
		<?php $shopProducts = $this->catalog_model->getShopProducts($shop->products) ?>
		<?php $userInfo = $this->catalog_model->getUserInfo	($shop->user_id) ?>
		<?php $shopComments = $this->catalog_model->commentsForShop($shop->shop_id) ?>
		<?php $shopCoupon = $this->catalog_model->couponForShop($shop->shop_id) ?>
		<li class="listGrid" rel="<?php echo $j ?>">
			<div class="product_grid">
					<div class="shop_contant">
						<div class="clearfix"></div>
						<div class="shop_image">
						<?php if (sizeof($shopProducts)>1) : ?>
							<ul class="bxslider" id="<?php echo 'box-' . $j ?>">
							<?php $i=1; ?>
								<?php foreach ($shopProducts as $product) : ?>
									<li rel="<?php echo $i++ ?>">
										<div class = "product_name"><a href="<?php echo base_url();?>catalog/product/<?php echo $storeInfo[0]->store_name . '/' . $product->url_key ?>" ><?php echo $product->product_name ?></a></div>
										<img src="<?php echo base_url();?>asset/img/store/<?php echo $product->store_id .'/'. $product->product_image ?>"/>									
									</li>
								<?php endforeach ?>
							</ul>
							<div class="tumb_image" rel="<?php echo $j ?>">
								<ul>
								<?php $i=1; ?>
								<?php foreach ($shopProducts as $product) : ?>
									<li rel="<?php echo $i++ ?>">
										<img  src="<?php echo base_url();?>asset/img/store/<?php echo $product->store_id .'/'. $product->product_image ?>"/>
									</li>
								<?php endforeach ?>
								</ul>
							</div>						
						<?php else : ?>
						<?php $i=2; ?>
							<img class="shop-photo" src="<?php echo base_url();?>asset/img/shops/<?php echo $shop->shop_image ?>"/>  
						<?php endif ?>
					</div>
				</div>	
				<div class = "grid_foot">
					<img src="https://graph.facebook.com/<?php echo $shop->user_id ?>/picture"/>
					<div class = "title">
					<span><?php echo $shop->shop_title ?></span>
					<p><?php echo $userInfo[0]->user_name ?></p>
					</div>
					<a href="/shops/popup/<?php echo $shop->shop_id ?>" class="fancybox"><img src="<?php echo base_url();?>asset/img/show_shop.png"/></a> 				
					<ul>
						<li>
							<div class="subj" >פריטים</div>
							<div class="desc" ><?php echo sizeof($shopProducts) ?></div>
						</li>
						<li>
							<div class="subj" >סכום הקנייה</div>
							<div class="desc" ><?php echo !empty($shop->shop_price) ? $shop->shop_price . ' ש"ח ' : "לא צויין"; ?></div>
						</li>
						<li>
							<div class="subj" >בית עסק</div>
							<div class="desc" ><?php echo $storeInfo[0]->store_name ?></div>
						</li>
						<li>
							<div class="subj" >קופון</div>
							<div class="desc" >  על כל הקולקציה50 אחוז הנחה בקסטרו</div>
						</li>
						<li>
							<div class="subj" >שתף חברים</div>
							<div class="desc" ><iframe class="facebook_like" allowTransparency='true' frameborder='0' scrolling='no' src='http://www.facebook.com/plugins/like.php?href=<?php echo base_url() . '/catalog/shops/' . $shop->shop_id ?>&send=false&layout=button_count&width=40&show_faces=false&action=like&colorscheme=light&height=2'></iframe></div>
						</li>							
					</ul>

				</div>	
			</div>
		</li>
	<?php endforeach ?>
	<div class = "more_result"></div>
	
</ul>

</div>



<script type="text/javascript">
	$(document).ready(function(){
  $('.bxslider').bxSlider({
   mode:'fade',
   touchEnabled:true,
   swipeThreshold:true
  });	
  
  
/*   
		$('.tumb_image').hoverIntent(overimg,outimg);
		 function overimg(){ 
				$('.tumb_image[rel=' + $(this).attr('rel') + ']').animate({opacity: 1,}, 200);	
		 }
		 function outimg(){ 
		 	$('.tumb_image[rel=' + $(this).attr('rel') + ']').animate({opacity: 0,}, 200);			
		}
 */		
	$(document).ready(function(){			 
		$('.listGrid').hoverIntent(overimg1,outimg1);
		 function overimg1(){ $(this).addClass('overshop'); $(this).find(".bx-controls-direction a , .product_name").show()}
		 function outimg1(){ $(this).removeClass('overshop'); $(this).find(".bx-controls-direction a , .product_name").hide()}
	});

var footheight =  $(".grid_foot").height();
var offset1;
var curHeight;
 $(".grid_foot").draggable({
        helper: function(){
            // Create an invisible div as the helper. It will move and
            // follow the cursor as usual.
            return $('<div></div>').css('opacity',0);
        },
        drag: function(event, ui){
            // During dragging, animate the original object to
            // follow the invisible helper with custom easing.
			
            var p = ui.helper.position();
			diff = 180 - p.top;
			if (offset1 <= diff){
				//$(this).height(180);
				p.top = 40;
			} else {
				//$(this).height(60);
				p.top = 180;
			}
			offset1 = diff;
            $(this).stop().animate({
                top: p.top,
            },1000,'easeOutCirc');
        }
    });
	
	
		$('.tumb_image li').click(function(){
			var parentRel = $(this).closest(".listGrid").attr('rel');
			var parentElement = $('.listGrid [rel=' + parentRel + ']');
			var image = $('#box-' + parentRel + ' li[rel=' + $(this).attr('rel') + ']');
			var allImages = $('#box-' + parentRel + ' li');
			allImages.each(function() {
				$(this).css('z-index','0');	
				$(this).hide();	
			});
			image.css('z-index','50');	
			image.fadeIn();	
			
		});
		
	  $(".product_title").click(function () {
			$(this).toggleClass("push_title", 1000, "easeOutSine" );
			return false;
	  });
		
	 });
</script>

 <script type="text/javascript">
 $(document).ready(function(){	
            var page = 1;

            $(window).scroll(function () {
               // $('#more').hide();
              //  $('#no-more').hide();
			 

                if($(window).scrollTop() + $(window).height() > $(document).height() - 600) {
					
                  //  $('#more').show();
                }
				
				var scrolling = $(window).scrollTop() + $(window).height();
				var winh = $(document).height();
				 console.log(winh - scrolling);
                if((winh - scrolling)<600) {
				
                  //  $('#more').show();
					// window.setInterval(loading, 2000);
                  //  $('#no-more').hide();

                    page++;

                    var actual_count = "<?php echo $last_shops_cnt; ?>";
console.log(actual_count);
                    if((page-1)* 9 > actual_count){
					 console.log('niso');
                      //  $('#no-more').css("top","400");
                      //  $('#no-more').show();
                    }else{
					url = '<?php echo base_url();?>' + getUrl('<?php echo $page ?>') + page;
                        $.ajax({
                            type: "POST",
                            url: url,
							data:getParams('<?php echo $page ?>'),
							beforeSend:  function(){
								$("#loading").show();
								// setTimeout(function(){getNewUpdates();}, 58000);
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
			
function getParams(view) {
	switch(view)
	{
	case 'category':
	  return '&categoryId=<?php echo isset($categoryId) ? $categoryId : '' ?>&view=<?php echo $view ?>&freinds=<?php echo $freinds ?>' ;
	  break;
 	case 'store':
	  return '&storeId=<?php echo isset($storeId) ? $storeId : '' ?>&view=<?php echo $view ?>&freinds=<?php echo $freinds ?>' ;
	  break;
	case 'user':
	  return '&userId=<?php echo isset($userId) ? $userId : '' ?>' ;
	  break; 
	case 'home':
	  return '' ;
	  break; 
	default:
	  return '';
	}
}
	
function getUrl(view) {
	switch(view)
	{
	case 'category':
	  return 'shops/category/' ;
	  break;
	case 'store':
	  return 'shops/store/' ;
	  break;
	case 'user':
	  return 'shops/user/' ;
	  break;
	case 'home':
	  return 'shops/index/' ;
	  break;
	default:
	  return 'shops/index/';
	}
}
			
});
        </script>