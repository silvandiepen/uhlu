<section id="list">
<!--
	<nav>Order by
		<ul>
			<li><a href="?order=name">Name</a></li>
			<li><a href="?order=date">Date</a></li>
		</ul>
	</nav>
-->
	<div class="list">
	<ul>
	<?php
		if(empty($_GET['order'])){ $order = 'title'; } else { $order = $_GET['order']; }
		if(isset($_GET['cat'])){
			$cat = "and JSON_EXTRACT(category, ".IdBySlug($_GET['cat']).")";
		} else { $cat = ''; }
		$qry = "SELECT * FROM item WHERE status=1 ".$cat." ORDER BY ".$order;
		$total = mysql_num_rows(mysql_query($qry));
		$result = mysql_query($qry);
		while ($row = mysql_fetch_array($result)){
			$list = json_decode($row['category']);
			$tags = '';
			foreach($list as $tagID){
				$tags .= '<span>#'.titleById($tagID,'category').'</span>'; 
			}
			$type = SlugbyID($row['type'],'type');
			
			
				
			
	    echo '<li class="'.$type.'"><a href="http://'.$type.'.com/'.$row['slug'].'">'.$row['title'].'<span class="tags">'.$tags.'</a></a></li>';
		}
		?>
	</ul>
	</div>
	<hr />
	<div class="total">
		total of <strong><?php echo $total; ?></strong> entries.
	</div>
</section>
