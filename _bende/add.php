<?php
	$error = '';
	if($_SERVER['REQUEST_METHOD'] == "POST"){
	if(isset($_POST['link'])){
		if(strpos($_POST['link'],'instagram')){
			$value = stripUrl($_POST['link'],'instagram');
			$error = insert($_POST,$value,IDbySlug('instagram','type'));
		} elseif(empty($_POST['link'])) {
			$error = 'Thats a nothing, can\'t do shit with nothing';
		} else {
			$error = 'This website isn\'t supported (yet)..';
		}
	}
}
?>
<section id="add">
	<div class="row">
		<div class="column small-12">
			<span><?php echo $error; ?></span>
			<form action="#" method="post">
				<label>Link</label><input type="text" name="link" /><br />
				<label>Title</label><input type="text" name="title" /><br />
				<label>Tags</label><input type="text" name="tag" value="sexy,chick,hot,"/><br />
				<label>Category</label>
				<?php
					$sql = "SELECT * FROM category WHERE parent=0";
					$result = mysql_query($sql);	
					
					
				?>
				<label></label><input type="submit" value="Add" />
			</form>

		</div>
	</div>
</section>
