<?php

namespace Controller;

use Interfaces\Controllable;

class Remote
{
	protected $system;

	protected $activeRoom;

	protected $activeDevice;

    public function __construct(System $system) {

    	$this->system = $system;
    }

    public function selectRoom($room) {

    	$this->setActiveRoom($this->system->getRoom($room));
    }

    protected function setActiveRoom(Room $room) {

    	$this->activeRoom = $room;
    }

    public function selectDevice(Device $device) {

	    /** @todo
	     * when user tries to select a device, we should check for an active room and throw a
	     * RoomNotSelectedException('please select a room to control.') if none is selected.
	     */
        $this->activeDevice = $device;
    }

    protected function findDevice() {

    }
}
