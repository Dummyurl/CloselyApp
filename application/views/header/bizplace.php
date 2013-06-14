
	<div id="top-widget-holder">
		<img src="<?php echo base_url();?>asset/img/social/tweeter_s.png" alt="Post" class="fbicon" />
		<img src="<?php echo base_url();?>asset/img/social/facebook_s.png" alt="Post" class="fbicon" />
		<img src="<?php echo base_url();?>asset/img/social/google_s.png" alt="Post" class="fbicon" />
		<img src="<?php echo base_url();?>asset/img/social/youtube_s.png" alt="Post" class="fbicon" />
		<div class="coupon_bt">+ הוסף קנייה</div>
				<div class="wrapper">
					
						<div class="top-panel">
							<a href="#" class="login_bt" onclick="fb_login();"><img src="<?php echo base_url();?>asset/img/facbooklogin.png" /></a>
							<a href="#" class="login_bt"><img src="<?php echo base_url();?>asset/img/bt_div.png" /></a>
							<a href="#" class="login_bt"><img src="<?php echo base_url();?>asset/img/bizlogin.png" /></a>
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

  };

function fb_login(){
    FB.login(function(response) {

        if (response.authResponse) {
            console.log('Welcome!  Fetching your information.... ');
            //console.log(response); // dump complete info
            access_token = response.authResponse.accessToken; //get access token
            user_id = response.authResponse.userID; //get FB UID

            FB.api('/me', function(response) {
                user_email = response.email; //get user email
          // you can store this data into your database             
            });

        } else {
            //user hit cancel button
            console.log('User cancelled login or did not fully authorize.');

        }
    }, {
        scope: 'publish_stream,email'
    });
}
(function() {
    var e = document.createElement('script');
    e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
    e.async = true;
    document.getElementById('fb-root').appendChild(e);
}());


</script>