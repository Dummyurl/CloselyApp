<?php $this->load->helper('url'); ?>	
<!doctype html>
<html class="no-js">	
	<head>
		<?php $this->load->view('head/meta'); ?>
		<?php $this->load->view('head/css'); ?>
		<script src="<?php echo base_url();?>asset/js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=he&libraries=places"></script>
		<link rel="stylesheet" media="all" href="<?php echo base_url();?>asset/css/jquery.thumbnailScroller.css"/>
		<?php $this->load->view('head/storelocation',$location); ?>
	</head>	
	<body onload="initialize()">
	<div class="popup">
		<div class="header header_orange" >
		<div class="fav"></div>
		<div class="title"><?php echo $shop->shop_title;?></div>
		<div class="triangle"></div>
		</div>
		<div class="content">
			<div class="shop">
				<div class="picture">
					<?php if (!empty($shop->price)) : ?>
						<div class="price_tag"><?php echo $shop->price ?></div>
					<?php else : ?>	
						<div class="price_tag">לא צויין מחיר</div>
					<?php endif ?>	
					<img src="<?php echo base_url();?>asset/img/shops/<?php echo $shop->shop_image;?>"  />
				</div>
				
				<div class="info">
					<div class="headerblock">פרטי הקנייה</div>
					<div class="triangle"></div>
					<div class="contentblock">
					<ul class="info_list">
						<li class="info_row">
							<div class="tag">:שם הקנייה</div>
							<div class="detial"><?php echo $shop->shop_title;?></div>
						</li>
						<li class="info_row">
							<div class="tag">:קנייה</div>
							<div class="detial"><?php echo $shop->shop_time;?></div>
						</li>
						<li class="info_row">
							<div class="tag">:עסק</div>
							<div class="detial"><?php echo $location['info']->store_name ?></div>
						</li>
						<li class="info_row">
							<div class="tag">:קטגוריה</div>
							<div class="detial"><?php echo $category[0]->category_name ?></div>
						</li>
						<li class="info_row">
							<div class="tag">:תיאור</div>
							<div class="detial"><?php echo $shop->shop_description; ?></div>
						</li>
					</ul>

					</div>
				</div>
				<div class="recommands">
					<div class="headerblock">המלצות על בית העסק</div>
					<div class="triangle"></div>
					<div class="contentblock">
					<ul class="store_recommand_list">
					<?php foreach($lastRecommands as $recommand) : ?>
					<?php $username = $this->users_model->getUserName($recommand->user_id); ?>
						<li class="recommand_row">
							<div class="user_image"><img src="https://graph.facebook.com/<?php echo $recommand->user_id ?>/picture"/></div>
							<div class="comment_bubble">
								<div class="rating"><div class="auto" style="width:<?php echo 21.2*$recommand->rating ?>px"></div></div>
								<div class="user_recommend">
									<div class="user_name"><?php echo $username ?></div>
									<div class="text_recommand"><?php echo $recommand->description ?></div>
								</div>
							</div>
							
						</li>
					<?php endforeach ?>

					</ul>
				<div class="more_recommands">
					<p>קרא עוד המלצות</p>
				</div>
					</div>
				</div>
				<div class="mycoupon">
					<?php $this->load->view('blocks/singlebanner',$coupon); ?>
				</div>
				<div id="locationField">
					 <input id="autocomplete" type="text" /> 
				</div>
				<div id="map_canvas"></div>
				<div id="listing"><table id="results"></table></div>
			</div>
		</div>	
	</div>
	</body>
</html>

