<?php

	$class1 = new class {

		public $time = '1:00';
		public $day = 'today';

		public function getDay() {

			return $this->day;
		}

		public function getTime() {

			return $this->time;
		}
	};

	$class2 = new class {

		public $color = 'red';
		public $art = 'image';
	};

	var_dump($class1->time);
	var_dump($class1->getDay());