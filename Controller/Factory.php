<?php

	namespace Controller;

	class Factory implements \Interfaces\BuilderInterface
	{
		static $objects = [
			'device' => Device::class,
			'room' => Room::class
		];

		static function make($object, ...$params) {

			$object = self::$objects[$object];

			return new $object(...$params);
		}
	}