<?php

	require_once '../vendor/autoload.php';

	function makeDevice() {

		$faker = \Faker\Factory::create();
		$device = new stdClass();
		$device->name = $faker->name;
		$device->status = $faker->name;
		$device->type = $faker->name;

		return $device;
	}

	$obj = new stdClass();
	$obj->name = 'test room 1';

	$room = new \Controller\Collection();
	$room->add([makeDevice(), makeDevice(), makeDevice()]);
	$device = $room->find("status:bull");

	print_r($room);

	print_r($device);