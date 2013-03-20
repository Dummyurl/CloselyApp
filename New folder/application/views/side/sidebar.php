				<!-- right side boxes -->
			<?php $userLogggin = $fb_data['me'] ?>	
			<?php
			/* 			
			viewcode = 1 view only freinds
			viewcode = 0 view all memmbers
			*/
			?>	
			<?php $viewcode = empty($userLogggin) ? 1 : 0 ;	?>
			<?php $this->load->model('users_model'); ?>			
			<?php $news = json_encode(array('time' => date('Y-m-d H:i:s'),'view'=>$viewcode,'uid'=> $fb_data['me']['id'])); ?>

			<?php if($userLogggin): ?>
			<?php $id = $fb_data['me']['id'] ?>
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
									<?php $regFreinds[] = $uid  ?>
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
								<?php $MyFreinds = array('id'=>$id,'freinds'=> $regFreinds)  ?>
								<?php $this->users_model->updateFreindsList($MyFreinds) ?>
								
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
								<?php foreach ($latest as $lastType ) :?>
								<?php $user_name = $this->users_model->getUserName($lastType['user_id']) ?>
								<?php $gender = $this->users_model->getUserGender($lastType['user_id']) ?>
								<?php $store = $this->users_model->getStoreName($lastType['store_id']) ?>
								<?php if ($gender =='male') : ?>
									<?php $addText = ' הוסיף ' ?>
								<?php else : ?>
									<?php $addText = ' הוסיפה ' ?>
								<?php endif ?>
								<li class="box-row">
									<div class="line-contant">
										<img src="https://graph.facebook.com/<?php echo $lastType['user_id'] ?>/picture"/>
										<div class="feed_text"><?php echo $addText . ' ' . $lastType['feed'] . ' ב' . $store . ' ' .  $user_name  ?></div>
										<div class="feed_text title"><?php echo $lastType['title'] ?></div>
									</div>
								</li>
								<?php endforeach ?>
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
		//freinds
		
		$('#switch-1').click(function(){
		if ('<?php echo $userLogggin ?>'){
			if (!$(this).hasClass("selected_switch")) {
				$(this).addClass("selected_switch");
				$('#switch-2').removeClass("selected_switch");
				// getFreindsFeed();
			}	
		}			//do stuff
		});
		
		// evreyone
		$('#switch-2').click(function(){
			if (!$(this).hasClass("selected_switch")) {
				$(this).addClass("selected_switch");
				$('#switch-1').removeClass("selected_switch");
				// getAllFeed();	
			}		//do stuff

		});

	if (!'<?php echo $userLogggin ?>'){
		$('#switch-2').trigger('click');
	}
	
	getNewUpdates();	
	function getNewUpdates(){
		url = "<?php echo base_url();?>" + 'feed/getnews';
		$.ajax({  
				type: "POST",  
				url: url,  
				dataType: 'json',
				data: <?php echo $news ?>,  
				success: function(msg) {
					var result = msg;
					if(result != ''){
					$.each(result, function (key, data) {
					var newFeed = '<li class="box-row"><div class="line-contant"><img src="https://graph.facebook.com/' + data.user_id +
							  '/picture"/><div class="feed_text"> ' + (data.gender == 'male') ? ' הוסיף ' : 'הוסיפה' + data.feed + ' ' +  data.user_name +
						      '</div><div class="feed_text title">' + data.title + '</div></div></li>';
							  
						 $('.contant-box-feed ul li:first').before($(newFeed).fadeIn('slow'));
					});
					
					}
				}  
				});
		setTimeout(function(){getNewUpdates();}, 58000);
    }
	
/* 	function getAllFeed(){
		url = "<?php echo base_url();?>" + 'feed/getfeed';
		$.ajax({  
				type: "POST",  
				url: url,  
				dataType: 'json',
				data: <?php echo json_encode(array('view'=>0)) ?>,  
				success: function(msg) {
				console.log(msg);
					// $('.contant-box-feed').html(msg);
					}	 
				});		
    }
	
	function getFreindsFeed(){
		url = '<?php echo base_url();?>' + 'feed/getfeed';
		$.ajax({  
				type: "POST",  
				url: url,  
				dataType: 'json',
				data: <?php echo json_encode(array('view'=>'1','uid'=> $fb_data['me']['id'])) ?>,  
				success: function(msg) {
				console.log('dsfsdfsdf');
					// $('.contant-box-feed').html(msg);
					}
					 
				});		
    } */
	
	}); 
</script>