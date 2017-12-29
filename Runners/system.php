<?php

	require_once '../vendor/autoload.php';

	$system = new \Controller\System('../system.json');

	$remote = new \Controller\Remote($system);

	$remote->selectRoom('kitchen');

	print_r($remote);


