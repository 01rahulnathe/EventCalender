<?php

	$eventArray = array();
	session_start();

	if(!file_exists('users/'. $_SESSION['username']. '.xml')){
		exit;
	}

	$products = simplexml_load_file('users/'. $_SESSION['username']. '.xml');
	foreach($products->events as $event){
		array_push($eventArray, $event);
	}
	echo json_encode($eventArray);

?>