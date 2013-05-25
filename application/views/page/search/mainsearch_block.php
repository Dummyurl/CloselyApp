<?php $this->load->helper('url'); ?>
<?php $searchTab = array('stores'=>'עסקים','shopping'=>'קניות','coupons'=>'קופונים','recommands'=>'המלצות','products'=>'מוצרים','branches'=>'סניפים','fusers'=>'משתמשים') ?>
<ul>
<?php foreach ($searchResult as $table=>$result ) : ?>
<li class="tabline">
	<div class="tableName">
		<?php echo $searchTab[$table]; ?>
	</div>
	<ul>
	<?php foreach ($result as $row ) : ?>
		<li class="box-row">
			<div class="line-contant search_addon">
				<a href="<?php echo $row['url'] ?>"><img src="<?php echo $row['image'] ?>" /></a>
				<a href="<?php echo $row['url'] ?>"><div class="feed_text title" id="res_title"><?php echo $row['title'] ?></div></a>
				<div class="feed_text"><?php echo $row['description'] ?></div>
			</div>
		</li>
	<?php endforeach ?>
	</ul>
</li>
<?php endforeach ?>
</ul>


<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
	$(".box-row").click(function(){
	$(this).show();
		var title = $(this).find('#res_title').text();
		var url = title.replace(" ", "_");
		console.log(url);
		$('#category-search').val(title);
		$("#divResult").hide();
	});
});
</script>	