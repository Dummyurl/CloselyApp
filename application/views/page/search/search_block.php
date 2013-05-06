<?php $this->load->helper('url'); ?>
<ul>
<?php foreach ($searchResult as $result ) : ?>
<li class="box-row">
	<div class="line-contant search_addon">
		<a href="<?php echo base_url();?>search/<?php echo $result['table'] . '/' . $result['id'] ?>"><img src="<?php echo $result['image'] ?>" /></a>
		<a href="<?php echo base_url();?>search/<?php echo $result['table'] . '/' . $result['id'] ?>"><div class="feed_text title" id="res_title"><?php echo $result['title'] ?></a></div>
		<div class="feed_text"><?php echo $result['description'] ?></div>
	</div>
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