
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
</script>

<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
  FB.init({
      appId      : '233297683465645', // App ID
      channelUrl : '//www.shoppix.co.il/channel.php', // Channel File
    status     : true, // check login status
    cookie     : true, // enable cookies to allow the server to access the session
    xfbml      : true  // parse XFBML
  });

  // Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
  // for any authentication related change, such as login, logout or session refresh. This means that
  // whenever someone who was previously logged out tries to log in again, the correct case below 
  // will be handled. 
  FB.Event.subscribe('auth.authResponseChange', function(response) {
    // Here we specify what we do with the response anytime this event occurs. 
    if (response.status === 'connected') {
      // The response object is returned with a status field that lets the app know the current
      // login status of the person. In this case, we're handling the situation where they 
      // have logged in to the app.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // In this case, the person is logged into Facebook, but not into the app, so we call
      // FB.login() to prompt them to do so. 
      // In real-life usage, you wouldn't want to immediately prompt someone to login 
      // like this, for two reasons:
      // (1) JavaScript created popup windows are blocked by most browsers unless they 
      // result from direct interaction from people using the app (such as a mouse click)
      // (2) it is a bad experience to be continually prompted to login upon page load.
      FB.login();
    } else {
      // In this case, the person is not logged into Facebook, so we call the login() 
      // function to prompt them to do so. Note that at this stage there is no indication
      // of whether they are logged into the app. If they aren't then they'll see the Login
      // dialog right after they log in to Facebook. 
      // The same caveats as above apply to the FB.login() call here.
      FB.login();
    }
  });
  };

  // Load the SDK asynchronously
  (function(d){
   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   ref.parentNode.insertBefore(js, ref);
  }(document));

  // Here we run a very simple test of the Graph API after login is successful. 
  // This testAPI() function is only called in those cases. 
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Good to see you, ' + response.name + '.');
    });
  }
</script>

<!--
  Below we include the Login Button social plugin. This button uses the JavaScript SDK to
  present a graphical Login button that triggers the FB.login() function when clicked.

  Learn more about options for the login button plugin:
  /docs/reference/plugins/login/ -->

<fb:login-button show-faces="true" width="200" max-rows="1"></fb:login-button>			