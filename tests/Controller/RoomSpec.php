<?php

namespace tests\Controller;

use Controller\Room;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RoomSpec extends ObjectBehavior
{
	public function createDevice() {

		$faker = \Faker\Factory::create();

		$device = new \stdClass();
		$device->type = $faker->name;
		$device->status = $faker->name;
		$device->name = $faker->name;

		return $device;
	}

	public function let(\stdClass $room) {

		$room->name = 'room1';
		$room->devices = [$this->createDevice(), $this->createDevice()];

		$this->beConstructedWith($room);
	}

    public function it_is_initializable() {

        $this->shouldHaveType(Room::class);
    }

    public function it_can_get_room_name() {

		$this->getName()->shouldReturn('room1');
    }
}
