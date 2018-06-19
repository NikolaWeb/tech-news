<?php
	include 'connection.php';
	
	if(!isset($_REQUEST['page']) || !is_numeric($_REQUEST['page']))
	{
		$pageid = 1;
	}
	else
	{
		$pageid = $_REQUEST['page'];
	}
	
	$query = "SELECT * FROM menu WHERE id_menu = $pageid";

    $pageinfo = $conn->query($query)->fetch();
 ?>