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

		$device1 = new \stdClass();
		$device1->type = 'test1';
		$device1->status = 'active';
		$device1->name = 'dev1';

		$device2 = new \stdClass();
		$device2->type = 'test2';
		$device2->name = 'dev2';

		$room->name = 'room1';
		$room->devices = [$device1, $device2];

		$this->beConstructedWith($room);
	}

    public function it_is_initializable() {

        $this->shouldHaveType(Room::class);
    }

    public function it_can_get_room_name() {

		$this->getName()->shouldReturn('room1');
    }

    public function it_can_get_devices_count() {

		$this->count()->shouldReturn(2);
    }

    public function it_can_add_device() {

		$this->add($this->createDevice(), \Controller\Factory::class, 'device');
		$this->count()->shouldReturn(3);
    }

    public function it_can_add_devices() {

		$this->add([$this->createDevice(), $this->createDevice(), $this->createDevice()], \Controller\Factory::class, 'device');
		$this->count()->shouldReturn(5);
    }

//    public function it_can_remove_device() {
//
//	    $this->count()->shouldReturn(2);
//	    $this->addDevice($device1 = $this->createDevice());
//	    $this->count()->shouldReturn(3);
//	    $this->addDevice($device2 = $this->createDevice());
//	    $this->count()->shouldReturn(4);
//
//	    $this->removeDevice($device1);
//	    $this->count()->shouldReturn(3);
//	    $this->removeDevice($device2);
//	    $this->count()->shouldReturn(2);
//    }

//	public function it_can_remove_device_by_device_name() {
//
//		$this->removeDevice('dev2');
//		$this->removeDevice('dev1');
//		$this->count()->shouldReturn(1);
//	}

	public function it_can_find_device_by_device_name() {

		$this->find('name:dev1', \Controller\Device::class)->shouldHaveType(\Controller\Device::class);
	}

	public function it_can_find_device_by_device_type() {

		$this->find('type:test1')->shouldHaveType(\Controller\Device::class);
	}

	public function it_can_find_device_by_device_status() {

		$this->add($dev = $this->createDevice(), \Controller\Factory::class, 'device');
		$this->find('status:active')->shouldHaveType(\Controller\Device::class);
		$this->find("status:{$dev->status}")->shouldHaveType(\Controller\Device::class);
	}
}
