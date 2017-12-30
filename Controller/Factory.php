<?php

	namespace Controller;

	class Factory implements \Controller\Interfaces\BuilderInterface
	{
		static $objects = [
			'device' => Device::class,
			'room' => Room::class
		];

		static function make($object, $params = null) {

			$object = self::$objects[$object];

			return new $object($params);
		}
	}