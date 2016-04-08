<?php
	
	include('connect.php');

	include('functions.php');


	if(isset($_GET['add'])){
		include('add.php');
	}
	include('root/header.php');


	include('root/footer.php');
	
	$client_id = '7606640fcd3a445490dcec00e46f02f2';
	$client_secret = 'ad2d5d9e70994533aa4a659a4f93304b';
	$redirect_url = 'http://uhlu.nl/data';
	$code = '';
	

?>