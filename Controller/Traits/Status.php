<?php

	namespace Controller\Traits;

	trait Status
	{
		protected $status;

		protected function setStatus($status) {

			$this->status = $status;
		}

		public function getStatus() {

			return $this->status;
		}
	}