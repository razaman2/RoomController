<?php

	namespace Controller;

	class Room
	{
		use \Controller\Traits\Name, \Controller\Traits\Collection;

		public function __construct($room) {

			$this->setName($room->name);

			foreach($room->devices as $device) {

				$this->add($device,Factory::class, 'device');
			}
		}

		public function removeDevice($device) {

			$index = in_array($device, $this->collection);

			unset($this->collection[$index]);
		}
	}