<?php

	namespace Controller;

	class ConfigurationValidator
	{
		static function validate($json) {

			if($json = json_decode($json)) {

				return $json;
			}

			throw new \Exceptions\InvalidConfigurationException('the configuration file has invalid data.');
		}
	}