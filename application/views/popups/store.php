<?php $this->load->helper('url'); ?>	
<!doctype html>
<html class="no-js">	
	<head>
		<?php $this->load->view('head/meta'); ?>
		<?php $this->load->view('head/css'); ?>
		<script src="<?php echo base_url();?>asset/js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=he&libraries=places"></script>
		<script src="<?php echo base_url();?>asset/js/storelocation.js"></script>
		<link rel="stylesheet" media="all" href="<?php echo base_url();?>asset/css/jquery.thumbnailScroller.css"/>
	</head>	
	<body onload="initialize()">
	<div class="popup">
		<div class="header header_orange" >
		<div class="buttons_collection">
			<div class="userbutton"><img src="<?php echo base_url();?>asset/img/likestore.png" /></div>
			<div class="userbutton"><img src="<?php echo base_url();?>asset/img/bizpage.png" /></div>
			<div class="userbutton"><img src="<?php echo base_url();?>asset/img/storesales.png" /></div>
		</div>
		<div class="fav"></div>
		<div class="title"><?php echo $store->store_name;?></div>
		<div class="triangle"></div>
		</div>
		<div class="content">
			<div class="store">
				<div class="picture"><img src="<?php echo base_url();?>asset/img/bizlogos/<?php echo $store->store_logo;?>"  /></div>
				<div class="info">
					<div class="headerblock">פרטי העסק</div>
					<div class="triangle"></div>
					<div class="contentblock">
					<ul class="store_info_list">
						<li class="info_row">
							<div class="tag">:שם העסק</div>
							<div class="detial"><?php echo $store->store_name;?></div>
						</li>
						<li class="info_row">
							<div class="tag">:כתובת</div>
							<div class="detial"><?php echo $store->store_address;?></div>
						</li>
						<li class="info_row">
							<div class="tag">:טלפון</div>
							<div class="detial"><?php echo '' ?></div>
						</li>
						<li class="info_row">
							<div class="tag">:אתר</div>
							<div class="detial"><?php echo '' ?></div>
						</li>
						<li class="info_row">
							<div class="tag">:תיאור</div>
							<div class="detial"><?php echo '' ?></div>
						</li>
					</ul>

					</div>
				</div>
				<div class="recommands">
					<div class="headerblock">המלצות</div>
					<div class="triangle"></div>
					<div class="contentblock">
					<ul class="store_recommand_list">
						<li class="recommand_row">
							<div class="user_image"><img src="https://graph.facebook.com/1130160922/picture"/></div>
							<div class="comment_bubble">
								<div class="rating"><img src="<?php echo base_url();?>asset/img/handsrating.png" /></div>
								<div class="user_recommend">
									<div class="user_name">Niso Mazuz</div>
									<div class="text_recommand">אחלה חנות קניתי שם מלא פעמים שווה כל שקל</div>
								</div>
							</div>
						</li>
						<li class="recommand_row">
							<div class="user_image"><img src="https://graph.facebook.com/1130160922/picture"/></div>
							<div class="comment_bubble">
								<div class="rating"><img src="<?php echo base_url();?>asset/img/handsrating.png" /></div>
								<div class="user_recommend">
									<div class="user_name">Niso Mazuz</div>
									<div class="text_recommand">אחלה חנות קניתי שם מלא פעמים שווה כל שקל</div>
								</div>
							</div>
						</li>
						<li class="recommand_row">
							<div class="user_image"><img src="https://graph.facebook.com/1130160922/picture"/></div>
							<div class="comment_bubble">
								<div class="rating"><img src="<?php echo base_url();?>asset/img/handsrating.png" /></div>
								<div class="user_recommend">
									<div class="user_name">Niso Mazuz</div>
									<div class="text_recommand">אחלה חנות קניתי שם מלא פעמים שווה כל שקל</div>
								</div>
							</div>
						</li>

					</ul>
				<div class="more_recommands">
					<p>קרא עוד המלצות</p>
				</div>
					</div>
				</div>
				<div class="sales">
					<div class="headerblock">לקוחות</div>
					<div class="triangle"></div>
					<div class="contentblock">
						<ul class="customers">
							<li class="sales_row"><a href="" ><img src="https://graph.facebook.com/1130160922/picture"/></a></li>
							<li class="sales_row"><a href="" ><img src="https://graph.facebook.com/1130160922/picture"/></a></li>
							<li class="sales_row"><a href="" ><img src="https://graph.facebook.com/1130160922/picture"/></a></li>
							<li class="sales_row"><a href="" ><img src="https://graph.facebook.com/1130160922/picture"/></a></li>
							<li class="sales_row"><a href="" ><img src="https://graph.facebook.com/1130160922/picture"/></a></li>
							<li class="sales_row"><a href="" ><img src="https://graph.facebook.com/1130160922/picture"/></a></li>
							<li class="sales_row"><a href="" ><img src="https://graph.facebook.com/1130160922/picture"/></a></li>
							<li class="sales_row"><a href="" ><img src="https://graph.facebook.com/1130160922/picture"/></a></li>
							<li class="sales_row"><a href="" ><img src="https://graph.facebook.com/1130160922/picture"/></a></li>
							<li class="sales_row"><a href="" ><img src="https://graph.facebook.com/1130160922/picture"/></a></li>

						</ul>					
					</div>
				</div>
				<div id="locationField">
					<!-- <input id="autocomplete" type="text" /> -->
				</div>
				<div id="map_canvas"></div>
				<div id="listing"><table id="results"></table></div>
			</div>
		</div>	
	</div>
	</body>
</html>

