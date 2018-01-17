<?php

namespace tests\Controller;

use Controller\Collection;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CollectionSpec extends ObjectBehavior
{
	function makeDevice() {

		$faker = \Faker\Factory::create();
		$device = new \stdClass();
		$device->name = $faker->name;
		$device->status = $faker->name;
		$device->type = $faker->name;

		return $device;
	}

    public function it_is_initializable() {

        $this->shouldHaveType(Collection::class);
    }

    public function it_can_count_items_in_collection() {

    	$this->count()->shouldReturn(0);
	    $this->add($this->makeDevice());
    	$this->count()->shouldReturn(1);
    }

    public function it_can_get_items_in_collection() {

		$this->get()->shouldHaveCount(0);
	    $this->add($this->makeDevice());
		$this->get()->shouldHaveCount(1);
    }

    public function it_can_add_item_to_collection() {

		$this->add($this->makeDevice());
		$this->count()->shouldReturn(1);
    }

    public function it_can_add_items_to_collection() {

		$this->add([$this->makeDevice(), $this->makeDevice(), $this->makeDevice()]);
		$this->count()->shouldReturn(3);
    }

    public function it_can_add_room_to_collection() {

		$this->add($this->makeDevice(), \Controller\Factory::class, 'room');
		$this->get()[0]->shouldHaveType(\Controller\Room::class);
    }

    public function it_can_add_device_to_collection() {

		$this->add($this->makeDevice(), \Controller\Factory::class, 'device');
		$this->get()[0]->shouldHaveType(\Controller\Device::class);
    }

    public function it_can_find_std_class_in_collection_by_the_value_of_any_property_name() {

		$this->add($item = $this->makeDevice());
		$this->find("name:{$item->name}")->name->shouldBeLike($item->name);
		$this->find("status:{$item->status}")->status->shouldBeLike($item->status);
    }

    public function it_can_find_array_in_collection_by_the_value_of_any_key() {

	    $this->add([
	    	['first_name'=>'john', 'last_name'=>'connor'],
		    ['first_name'=>'steve', 'last_name'=>'harvey'],
		    ['first_name'=>'jerry', 'last_name'=>'springer']
	    ]);

	    $this->find("first_name:jerry")['last_name']->shouldBeLike('springer');
	    $this->find("last_name:harvey")['first_name']->shouldBeLike('steve');
    }

    public function it_can_find_class_in_collection_by_the_value_of_any_public_property() {

		$class1 = new class {

			public $time = '1:00';
			public $day = 'today';

			public function getDay() {

				return $this->day;
			}

			public function getTime() {

				return $this->time;
			}
		};

	    $class2 = new class {

		    public $color = 'red';
		    public $art = 'image';
	    };

	    $this->add([$class1, $class2]);

	    $this->find("day:today")->time->shouldBeLike('1:00');
    }

	public function it_can_find_item_in_collection_by_key() {

		$this->add(['three', 'blind', 'mice']);
		$this->find('0')->shouldBeLike('three');
		$this->find(2)->shouldBeLike('mice');
	}
}
