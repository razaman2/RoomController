<?php

	namespace Controller\Interfaces;

	interface Adjustable
	{
		public function mute();

		public function volumeUp();

		public function volumeDn();
	}