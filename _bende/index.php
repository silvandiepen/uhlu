<?php
	error_reporting(E_ALL);

	include('connect.php');

	include('functions.php');


	if(isset($_GET['add'])){
		include('add.php');
	}
	include('root/header.php');

	include('list.php');
	
	include('tags.php');

	include('root/footer.php');

?>
