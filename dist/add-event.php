<?php

session_start();

if(!file_exists('users/'. $_SESSION['username']. '.xml')){
	exit;
}

$title = isset($_POST['title']) ? $_POST['title'] : "";
$start = isset($_POST['start']) ? $_POST['start'] : "";
$end = isset($_POST['end']) ? $_POST['end'] : "";

$xml = simplexml_load_file('users/'. $_SESSION['username']. '.xml');
$sxe = new SimpleXMLElement($xml->asXML());
$event = $sxe->addChild("events");
$event->addChild('title',  $title);
$event->addChild('start', $start);
$event->addChild('end', $end);


if($sxe->asXML('users/' . $_SESSION['username'] . '.xml')){
	echo 'Event created ..';			
}

?>