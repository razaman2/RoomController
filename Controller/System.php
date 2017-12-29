<?php

	namespace Controller;

	class System implements \Interfaces\Controllable, \Interfaces\Initializable
	{
		use \Controller\Traits\Name;

		protected $rooms = [];

		protected $initialized = false;

		public function __construct($configFile) {

			$this->initialize($configFile);
		}

		public function getRoom($room) {

			if($this->initialized) {

				return ($this->findRoom($room));
			}

			throw new \Exceptions\UninitializedSystemException('system is not initialized');
		}

		public function initialize($file) {

			$config = $this->readConfig($file);

			$this->setName($config->name);

			foreach($config->rooms as $room) {

				array_push($this->rooms,Factory::make('room', $room));
			}

			$this->initialized = true;
		}

		protected function readConfig($file) {

			if(file_exists($file)) {

				return ConfigurationValidator::validate(file_get_contents($file));
			}

			throw new \Exceptions\ConfigurationNotFoundException('failed to initialize system, cfg not found.');
		}

		protected function findRoom($name) {

			$room = array_filter($this->rooms,function (Room $room) use($name) {

				$name = $this->format($name);

				return preg_match("/{$name}/i", $this->format($room->getName()));
			});

			if(count($room) === 0) {

				throw new \Exceptions\RoomNotFoundException('the selected room is not a part of this system.');
			}

			return array_pop($room);
		}

		protected function format($name) {

			return preg_replace('/(\s)||(\W)||(_)/', '', $name);
		}
	}