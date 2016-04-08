<?php
	header('Content-Type: application/json');
	include('../connect.php');
	include('../functions.php');	
	
	
	$data = [];
	
	if(empty($_GET)){
		$result = mysql_query("SELECT * FROM item WHERE status=1");
		while ($row = mysql_fetch_array($result)){
			$data['item'][$row['ID']]['name'] = $row['slug'];
			$data['item'][$row['ID']]['title'] = $row['title'];
			$data['item'][$row['ID']]['type'] = TitleByID($row['type'],'type');
			$data['item'][$row['ID']]['url'] = 'http://'.SlugbyID($row['type'],'type').'.com/'.$row['slug'];	
			$data['item'][$row['ID']]['tags'] = convertToList(json_decode($row['category']),'comma');
		}
	}
	echo json_encode($data);
	
?>