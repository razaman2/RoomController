<?php

	namespace Controller\Interfaces;

	interface BuilderInterface
	{
		static function make($object, $params);
	}