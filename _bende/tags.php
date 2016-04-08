<section id="tags">
	<ul>
<?php
	
		$qry = "SELECT * FROM category";
		$total = mysql_num_rows(mysql_query($qry));
		$result = mysql_query($qry);
		while ($row = mysql_fetch_array($result)){
			
			echo '<li><a href="?cat='.$row['slug'].'">#'.$row['title'].'</a></li>';		
			
		}


?>
	</ul>
</section>