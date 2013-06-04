
	<div id="top-widget-holder">
		<img src="<?php echo base_url();?>asset/img/social/twitter.png" alt="Post" class="fbicon" />
		<img src="<?php echo base_url();?>asset/img/social/facebook.png" alt="Post" class="fbicon" />
		<img src="<?php echo base_url();?>asset/img/social/google.png" alt="Post" class="fbicon" />
				<div class="wrapper">
					
						<div class="top-panel">
							<span class="thispro">
							<input type="text" value="הזן קוד קופון">
							<div class="searchbutton search header_orange"><span class="search_text">שתף</span></div>
							</span>
							<div class="panel-shadow">
								<div class="user-panel" id="panel">
									<div class="face-text">
										<div class="user-panel-contant">
										<?php if(!$fb_data['me']): ?>
										<div class="panel_line">
											<img src="<?php echo base_url();?>asset/img/facebook1.png" alt="Post" class="fbicon" /><a href="<?php echo $fb_data['loginUrl']; ?>"  class="fbconnect" onclick = "facebookPopup(this.href); return false"><?php echo ' התחבר עם פייסבוק '; ?></a>
											<img class="biz-icon" src="<?php echo base_url();?>asset/img/bizicon.png" alt="Post" /><a href="#"><?php echo ' בעל עסק? לחץ כאן '; ?></a>	
										</div>
										<?php else: ?>
										<a href="#" class="open_panel"><img src="https://graph.facebook.com/<?php echo $fb_data['uid']; ?>/picture" alt="" class="smallpic" /><div class="user_text">פאנל משתמש</div></a>
										<div class="notification_icons">
										<img src="<?php echo base_url();?>asset/img/comment.png" alt="Post" class="fbicon" />
										<img src="<?php echo base_url();?>asset/img/cart.png" alt="Post" class="fbicon" style="margin:-3px 0px;" />
										<img src="<?php echo base_url();?>asset/img/request.png" alt="Post" class="fbicon" />
										<img src="<?php echo base_url();?>asset/img/coupons.png" alt="Post" class="fbicon" />
										</div>
										<div class="panel_contant">
										<img src="https://graph.facebook.com/<?php echo $fb_data['uid']; ?>/picture" alt="" class="pic" />
											<p><?php echo $fb_data['me']['name']; ?> ,הי<br />
										הודעות חדשות<a href="<?php echo $fb_data['logoutUrl']; ?>">7</a>יש לך
										</p>
										<div class="mypanel_buttons">
											<img src="<?php echo base_url();?>asset/img/buttons/mysetting.png" alt="Post" class="panel_btn" />
											<img src="<?php echo base_url();?>asset/img/buttons/myfav.png" alt="Post" class="panel_btn" />
											<img src="<?php echo base_url();?>asset/img/buttons/myclubs.png" alt="Post" class="panel_btn" />
											<img src="<?php echo base_url();?>asset/img/buttons/mycoupons.png" alt="Post" class="panel_btn" />
											<img src="<?php echo base_url();?>asset/img/buttons/myshops.png" alt="Post" class="panel_btn" />
										</div>
										<!-- <a href="<?php echo site_url('main/topsecret'); ?>">You can access the top secret page</a> or <a href="<?php echo $fb_data['logoutUrl']; ?>">logout</a> </p> -->
										</div>
										<?php endif; ?>
										</div>	
									</div>
								</div>
							</div>
						</div>
					
					<div id="top-widget">
						<div class="padding">
						<ul  class="widget-cols clearfix">
								<li class="first-col">
									<div class="widget-block">
										<h4>Recent posts</h4>
										<div class="recent-post">
											<a href="#" class="thumb"><img src="<?php echo base_url();?>asset/img/dummies/54x54.gif" alt="Post" /></a>
											<div class="post-head">
												<a href="#">Pellentesque habitant morbi senectus</a><span> March 12, 2011</span>
											</div>
										</div>
										<div class="recent-post">
											<a href="#" class="thumb"><img src="<?php echo base_url();?>asset/img/dummies/54x54.gif" alt="Post" /></a>
											<div class="post-head">
												<a href="#">Pellentesque habitant morbi senectus</a><span> March 12, 2011</span>
											</div>
										</div>
										<div class="recent-post">
											<a href="#" class="thumb"><img src="<?php echo base_url();?>asset/img/dummies/54x54.gif" alt="Post" /></a>
											<div class="post-head">
												<a href="#">Pellentesque habitant morbi senectus</a><span> March 12, 2011</span>
											</div>
										</div>
									</div>
								</li>
								
								<li class="second-col">
									
									<div class="widget-block">
										<h4>Dummy text</h4>
										<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies ege. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
										<p>Pellentesque habitant morbi tristique senectus et netus et malesuada.</p>
									</div>
									
								</li>
								
								<li class="third-col">
									
									<div class="widget-block">
										<h4>Dummy text</h4>
										<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies ege. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
										<p>Pellentesque habitant morbi tristique senectus et netus et malesuada.</p>
									</div>
					         		
								</li>
								
								<li class="fourth-col">
									
									<div class="widget-block">
										<h4>Dummy text</h4>
										<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies ege. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
										<p>Pellentesque habitant morbi tristique senectus et netus et malesuada.</p>
									</div>
					         		
								</li>	
							</ul>				
						</div>
					</div>
					<div class="side-top-img">

					<?php
/* 					<div class="feed">
						<div class="gradient_bg"></div>
						<div class="feed_line"><img src="https://graph.facebook.com/1130160922/picture" alt="Post" /></div>
						<div class="feed_line"><img src="https://graph.facebook.com/1130160922/picture" alt="Post" /></div>
						<div class="feed_line"><img src="https://graph.facebook.com/1130160922/picture" alt="Post" /></div>
					</div> */
					?>
					<?php /* <img src="<?php echo base_url();?>asset/img/banners/topbanner.png" alt="Post" /> */ ?>
					<div class="find">חפש</div>
						<input type="text" value="חפש כל דבר" name="findme" id="searchOnsite">
						<div id="boxResult"></div>
					</div>
				
				</div>


			</div>
			
<script type="text/javascript">
	function facebookPopup (url) {
		popup = window.open(url, "facebook_popup",
		"width=620,height=400,status=no,scrollbars=no,resizable=no");
		popup.focus();
	}
	
	function CloseAndRefresh() 
    {
        window.opener.location.href = window.opener.location.href;
        window.close();
    }
	
$(document).ready(function(){

	// Remove search bar text on foucos
	var Input = $('input[name=findme]');
	var default_value = Input.val();
	Input.focus(function() {
		if(Input.val() == default_value) Input.val("");
	}).blur(function(){
		// $('#divResult').hide();
		if(Input.val().length == 0) Input.val(default_value);
	});
	
	$("#searchOnsite").keyup(function() 
	{ 
	var inputSearch = $(this).val();
	var dataString = 'word='+ encodeURI(inputSearch);
	var returl  = '<?php echo base_url();?>' + 'feed/getAllResult';
	if(inputSearch!='')
	{
		$.ajax({
		type: "POST",
		url: returl,
		data: dataString,
		cache: false,
		success: function(html)
		{
		$("#boxResult").html(html).show();
		}
		});
	} else {
	$("#boxResult").hide();
	return false; 
	} 
	});

	
 }); 
</script>		zz	
			