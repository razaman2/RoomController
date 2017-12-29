<?php

	namespace tests\Controller;

	use Controller\System;
	use PhpSpec\ObjectBehavior;
	use Prophecy\Argument;

	class SystemSpec extends ObjectBehavior
	{
		public function let() {

			$this->beConstructedWith('system.json');
		}

		public function it_is_initializable() {

			$this->shouldHaveType(System::class);
		}

		public function it_should_be_able_to_return_a_room_using_the_room_name_provided() {

			$this->getRoom('kitchen')->shouldHaveType(\Controller\Room::class);
		}

		public function it_should_be_able_to_return_a_room_using_a_case_insensitive_room_name() {

			$this->getRoom('Living ROOM')->shouldHaveType(\Controller\Room::class);
		}

		public function it_should_throw_a_room_not_found_exception_if_the_provided_room_name_does_not_match_a_room() {

			$this->shouldThrow(\Exceptions\RoomNotFoundException::class)->duringGetRoom('family room');
		}

		public function it_should_find_a_room_without_providing_spaces_in_room_name() {

			$this->shouldNotThrow(\Exceptions\RoomNotFoundException::class)->duringGetRoom('livingroom');
		}

		public function it_should_find_a_room_without_providing_special_chars_in_room_name() {

			$this->shouldNotThrow(\Exceptions\RoomNotFoundException::class)->duringGetRoom('dashawns bedroom');
		}

		public function it_should_throw_a_configuration_not_found_exception_when_a_configuration_file_cannot_be_found() {

			$this->shouldThrow(\Exceptions\ConfigurationNotFoundException::class)->duringInitialize('invalid cfg file');
		}

		public function it_should_throw_invalid_configuration_exception_if_configuration_file_is_invalid() {

			$this->shouldThrow(\Exceptions\InvalidConfigurationException::class)->duringInitialize('.gitignore');
		}

		public function it_should_throw_an_uninitialized_system_exception_if_system_is_not_initialized() {

			$this->shouldNotThrow(\Exceptions\UninitializedSystemException::class)->duringGetRoom();
		}

		public function it_should_allow_cfg_file_to_be_set() {

			$this->shouldNotThrow(\Exceptions\ConfigurationNotFoundException::class)->duringInitialize('system.json');
		}
	}
