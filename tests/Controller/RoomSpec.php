<?php

namespace tests\Controller;

use Controller\Room;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RoomSpec extends ObjectBehavior
{
	public function let(\stdClass $room) {

		$room->name = 'room1';

		$room->devices = [];

		$this->beConstructedWith($room);
	}

    public function it_is_initializable() {

        $this->shouldHaveType(Room::class);
    }
}
