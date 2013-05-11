<?php $this->load->helper('url'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Bootstrap Responsive Login Form</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="a snippet of a bootstrap login form with fully responsive supported. Feel free to test and report a bugs to me :)">
		<meta name="author" content="arianraptor">

		<!-- Open Graph -->

		<meta property="og:title" content="Bootstrap Responsive Login Form" /> 
		<meta property="og:image" content="http://arianraptor.com/bootstrap-responsive-login-form/imgsrc.png" /> 
		<meta property="og:description" content="a snippet of a bootstrap login form with fully responsive supported. Feel free to test and report a bugs to me :)" /> 
		<meta property="og:url" content="http://arianraptor.com/bootstrap-responsive-login-form/">

		<!-- Styles -->
		<link rel="stylesheet" href="<?php echo base_url();?>asset/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>asset/css/bootstrap-responsive.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>asset/css/bootstrap-custom.css">


		<!-- HTML5 Shim, for IE6-IE8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script src="js/html5shiv.js"></script>
		<![endif]-->


        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
       	<script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-38395785-1']);
		  _gaq.push(['_trackPageview']);

		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		</script>

	</head>
	
		<body>    

	<!-- Navbar
    ================================================== -->

	<div id="wrap">
	<div class="container">
		<div class="row">
		
			<div class="span3 hidden-phone"></div>
			<div class="span6" id="form-login">
				<div class="login_container">
				<?php echo form_open("auth/login");?>
					<fieldset>
						<legend>התחברות עסקים</legend>
						<div id="infoMessage"><?php echo $message;?></div>	<!-- Navbar -->
						<div class="control-group">
							<div class="control-label">
								<label><?php echo lang('login_identity_label', 'indentity');?></label>
							</div>
							<div class="controls">
								<?php echo form_input($identity);?>
							</div>
						</div>

						<div class="control-group">
							<div class="control-label">
								<label> <?php echo lang('login_password_label', 'password');?></label>
							</div>
							<div class="controls">
								<?php echo form_input($password);?>
							</div>
						</div>
						
						<div class="control-group">
							<div class="control-label">
								<label><?php echo lang('login_remember_label', 'remember');?></label>
							</div>
							<div class="controls">
								<?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
							</div>
						</div>
						
						<?php echo form_input($redirecturl);?>
						
						<div class="control-group">
							<div class="controls">
							<a href="forgot_password"><?php echo lang('login_forgot_password');?></a>
							<?php echo form_submit('submit', lang('login_submit_btn'),'class="btn btn-primary button-loading" data-loading-text="Loading..."');?>
							
							</div>
						</div>
					</fieldset>
				<?php echo form_close();?>
				</div>
			</div>
			<div class="span3 hidden-phone"></div>
		</div>
	</div>
	<div id="push"></div>
	</div>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>asset/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>asset/js/bootstrap-button.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>asset/js/application.js"></script>

	</body>
</body>
</html>