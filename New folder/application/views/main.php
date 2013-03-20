<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('meta'); ?>
<?php $this->load->view('css',$css); ?>
<?php $this->load->view('js',$js); ?>
</head>
<body>
<?php $this->load->view('header'); ?>
<div id="main">	
			<div class="wrapper">
				<div id="slider-holder" class="clearfix">
					<div class="floated-content-home">
					<!--- תוכן --->
						<?php $this->load->view('page/home'); ?>
					<!--- סיום תוכן --->
					</div>
					<div class="home-slider-clearfix "></div>
					<?php $this->load->view('sidebar'); ?>
				</div>
			</div>
</div>
<?php $this->load->view('footer'); ?>
</body>
</html>