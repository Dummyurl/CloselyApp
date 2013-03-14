				<!-- right side boxes -->	
			<?php if($fb_data['me']): ?>
			<?php $id = $fb_data['me']['id'] ?>
			<?php $this->load->model('users_model'); ?>
			<?php $freinds = $this->users_model->getFreinds($id); ?>
			<?php $freinds_shops_cnt = 0; ?>
			<?php $freinds_coupons_cnt = 0; ?>
			<?php $freinds_comments_cnt = 0; ?>
			
			<div class="info_box">
				<div class="infobox-container"> 
						<div class="infobox big">  
							<h3><span>אזור חברים</span></h3> 
							<div class="triangle-l topfix"></div>
							<div class="search_freinds">
								<input type="text" value="...חפש חבר" />
							</div>
							<div class="contant-box fix_box">
								<div class="contant-box">
								<ul>
								<?php foreach ($freinds as $uid=>$name) : ?>
									<?php if ($this->users_model->isUserExist($uid)) : ?>
										<li class="box-row">
											<div class="line-contant">
											<img src="https://graph.facebook.com/<?php echo $uid ?>/picture"  />
											<div class="freind_name"><?php echo $name ?></div>
												<div class="freind_cnt"><div class="cnt_bubble"><?php echo $shopsCnt = $this->users_model->countShops($uid); ?></div><img src="<?php echo base_url();?>asset/img/cart.png"  /></div>
												<div class="freind_cnt"><div class="cnt_bubble"><?php echo $couponsCnt = $this->users_model->countCoupons($uid); ?></div><img src="<?php echo base_url();?>asset/img/coupons.png"  /></div>
												<div class="freind_cnt"><div class="cnt_bubble"><?php echo $commentsCnt = $this->users_model->countComments($uid); ?></div><img src="<?php echo base_url();?>asset/img/comment.png"  /></div>
											</div>
										</li>
										<?php $freinds_shops_cnt += $shopsCnt; ?>
										<?php $freinds_coupons_cnt += $couponsCnt; ?>
										<?php $freinds_comments_cnt += $commentsCnt; ?>
									<?php endif ?>
								<?php endforeach ?>
								</ul>
								</div>			
							</div>	
							<div class="buttons_container">
								<div class="freinds_button"><div class = "button_triangle"></div>[<span class="counter"><?php echo $freinds_shops_cnt ?></span>] קניות של חברים<img src="<?php echo base_url();?>asset/img/cart.png"  /></div>
								<div class="freinds_button"><div class = "button_triangle"></div>[<span class="counter"><?php echo $freinds_comments_cnt ?></span>] המלצות של חברים<img src="<?php echo base_url();?>asset/img/comment.png"  /></div>
								<div class="freinds_button"><div class = "button_triangle"></div>[<span class="counter"><?php echo $freinds_coupons_cnt ?></span>] קופונים של חברים<img src="<?php echo base_url();?>asset/img/coupons.png"  /></div>
							</div>	
						</div> 
				</div>
			</div>	
			<?php endif ?>			
			<div class="info_box">
				<div class="infobox-container"> 
				
						<div class="infobox" style="height:300px">  
							<h3><span>פעולות אחרונות</span></h3> 
							<div class="triangle-l topfix"></div>
							<div class="contant-box-feed">
								<div class="contant-box-feed">
								<ul>
								<li class="box-row">
									<div class="line-contant">
										<img src="https://graph.facebook.com/1130160922/picture"/>
										<div class="feed_text">Niso mazuz הוסיף קופון חדש בארומה</div>
										<div class="feed_text title">מאפה חינם בכל קנייה של קפה בוקר</div>
									</div>
								</li>
								<li class="box-row">
									<div class="line-contant">
										<img src="https://graph.facebook.com/1130160922/picture"/>
										<div class="feed_text">Niso mazuz הוסיף קופון חדש בארומה</div>
										<div class="feed_text title">מאפה חינם בכל קנייה של קפה בוקר</div>
									</div>
								</li>
								<li class="box-row">
									<div class="line-contant">
										<img src="https://graph.facebook.com/1130160922/picture"/>
										<div class="feed_text">Niso mazuz הוסיף קופון חדש בארומה</div>
										<div class="feed_text title">מאפה חינם בכל קנייה של קפה בוקר</div>
									</div>
								</li>
								<li class="box-row">
									<div class="line-contant">
										<img src="https://graph.facebook.com/1130160922/picture" />
										<div class="feed_text">Niso mazuz הוסיף קופון חדש בארומה</div>
										<div class="feed_text title">מאפה חינם בכל קנייה של קפה בוקר</div>
									</div>
								</li>
								</ul>
								</div>			
							</div>	
							<a href="" class="showswitch right_radius selected_switch" id="switch-1" onclick="return false;">החברים שלי</a>
							<a href="" class="showswitch left_radius" id="switch-2" onclick="return false;">כולם</a>								

						</div> 
				</div>
			</div>	
			
			
			
			<div class="info_box">
				<div class="infobox-container"> 
					
						<div class="infobox" style="height:284px"> 
							<h3><span>המבזבזים המובילים</span></h3> 
							<div class="top-buttons">
								<div class="triangle-l"></div>
								<ul>
									<li class="summery-type" rel="1"><a href="#" onClick="return false;">קניות</a></li>
									<li class="summery-type" rel="2"><a href="#" onClick="return false;">קופונים</a></li>
									<li class="summery-type" rel="3"><a href="#" onClick="return false;">המלצות</a></li>
								</ul>
							</div>	
							<div class="contant-box">
							<ul>
							<li class="box-row"><div class="line-contant"><img src="https://graph.facebook.com/1130160922/picture"  /></div></li>
							<li class="box-row"><div class="line-contant"><img src="https://graph.facebook.com/1130160922/picture"  /></div></li>
							<li class="box-row"><div class="line-contant"><img src="https://graph.facebook.com/1130160922/picture"  /></div></li>
							<li class="box-row"><div class="line-contant"><img src="https://graph.facebook.com/1130160922/picture"  /></div></li>
							<li class="box-row"><div class="line-contant"><img src="https://graph.facebook.com/1130160922/picture"  /></div></li>
							<li class="box-row"><div class="line-contant"><img src="https://graph.facebook.com/1130160922/picture"  /></div></li>
							</ul>
							</div>			
						</div> 
				</div>
			</div>	
	
			<!-- 
		    <div class="info_box">
				<div class="infobox-container"> 
						<div class="infobox"> 
							<h3><span>ניוזלטר</span></h3> 
							<div class="inputemail">
								<input type="text" value="הזן כתובת מייל" />
							</div>	
							<div class="codebutton buttonmail"><span class="buttontmailext">הרשם</span></div>	
							<div class="clearfix"></div>						
						</div> 
				</div>
			</div>
			 -->				
			
			<div class="info_box">
				<div class="infobox-container"> 
				
						<div class="infobox" style="height:300px">  
							<h3><span>עסקים מובילים</span></h3> 
							<div class="triangle-l topfix"></div>
							<div class="contant-box">
							<img class="cover" src="<?php echo base_url();?>asset/img/logobiz.png"/>
							</div>										
						</div> 
				</div>
			</div>	

				<!-- ENDS slider holder -->
<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$(function(){
			$('.contant-box ul').jScrollPane({
			});
		});
			
		$('#switch-1').click(function(){
			if (!$(this).hasClass("selected_switch")) {
				$(this).addClass("selected_switch");
				$('#switch-2').removeClass("selected_switch");
			}		//do stuff
		});
		$('#switch-2').click(function(){
			if (!$(this).hasClass("selected_switch")) {
				$(this).addClass("selected_switch");
				$('#switch-1').removeClass("selected_switch");
			}		//do stuff
		});

	}); 
</script>