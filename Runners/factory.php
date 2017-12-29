<?php

	require_once '../vendor/autoload.php';

	$room = new class {
		public $name = 'test';
		public $devices = ['device1','device2'];
	};

	$device1 = new class {
		public $name = 'device1';
		public $type = 'cable';
	};

	$device2 = new class {
		public $name = 'device2';
		public $type = 'television';
	};

	print_r(
		\Controller\Factory::make('device', $device1)
	);