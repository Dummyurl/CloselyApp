<?php $this->load->helper('url'); ?>
<!doctype html>
<html class="no-js">	
	<head>
		<?php $this->load->view('head/meta'); ?>
		<?php $this->load->view('head/css'); ?>
		<?php $this->load->view('head/js'); ?>
	</head>	
	<body lang="en" onload='CloseAndRefresh()'>
		<!-- loading animation div -->
		<div id="more" ></div>
		<header class="clearfix">
			<?php $this->load->view('header/bizplace'); ?>
			<?php $this->load->view('header/navigation'); ?>
		</header>
		<!-- MAIN -->
		<div id="main">	
			<div class="wrapper">
				<!-- slider holder -->
				<div id="slider-holder" class="clearfix">
					<div class="home-slider-clearfix "></div>
		        	<!-- Headline -->
					<?php $this->load->view('side/buttons',$records); ?>
		        	<!-- ENDS headline -->
					<!-- slider -->
					<div id="content-block">
					<?php $this->load->view('content',$content); ?>
					</div>		
					<?php $this->load->view('side/sidebar',$feed); ?>					
				</div>   		        	
			</div>
		</div>
		<!-- ENDS MAIN -->
		<footer>
			<?php $this->load->view('footer/footer'); ?>
		</footer>
	</body>
	
</html>