<?php

	namespace Controller;

	class Room
	{
		use \Controller\Traits\Name;

		protected $devices = [];

		public function __construct($room) {

			$this->setName($room->name);

			foreach($room->devices as $device) {

				$this->addDevice(Factory::make('device', $device));
			}
		}

		public function addDevice(Device $device) {

			array_push($this->devices, $device);
		}

		public function removeDevice($device) {

			$index = in_array($device, $this->devices);

			array_splice($this->devices, $index,1);
		}
	}