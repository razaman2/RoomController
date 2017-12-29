<?php

namespace Controller;

class Device
{
	use \Controller\Traits\Name, \Controller\Traits\Status;

	protected $type;

	public function __construct($device) {

		$this->type = $device->type;

		$this->setStatus($device->status ?? null);

		$this->setName($device->name ?? null);
	}

	public function getType() {

        return $this->type;
    }
}
