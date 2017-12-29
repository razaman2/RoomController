<?php

	namespace Controller\Traits;

	trait Name
	{
		protected $name;

		protected function setName($name) {

			$this->name = $name;
		}

		public function getName() {

			return $this->name;
		}
	}