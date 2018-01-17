<?php

	namespace Interfaces;

	interface BuilderInterface
	{
		static function make($object, ...$params);
	}