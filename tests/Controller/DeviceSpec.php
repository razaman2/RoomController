<?php

namespace tests\Controller;

use Controller\Device;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DeviceSpec extends ObjectBehavior
{
	public function let(\stdClass $device) {

		$device->type = 'cable';
		$device->status = 'active';
		$device->name = 'Living Room Box';

		$this->beConstructedWith($device);
	}

    public function it_is_initializable() {

        $this->shouldHaveType(Device::class);
    }

    public function it_can_get_device_name() {

		$this->getName()->shouldReturn('Living Room Box');
    }

    public function it_can_get_device_status() {

		$this->getStatus()->shouldReturn('active');
    }

    public function it_can_get_type() {

		$this->getType()->shouldReturn('cable');
    }
}
