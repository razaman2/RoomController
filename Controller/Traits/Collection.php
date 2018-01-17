<?php

	namespace Controller\Traits;

	trait Collection
	{
		protected $collection = [];

		public function add($entities, $factory = null, $type = null) {

			if(is_array($entities)) {

				foreach($entities as $entity) {

					array_push($this->collection,$factory ? $factory::{'make'}($type, $entity) : $entity);
				}
			} else {

				$this->add([$entities], $factory, $type);
			}
		}

		public function remove($entities) {

			$index = in_array($entities, $this->collection);

			unset($this->collection[$index]);
		}

		public function find($filter) {

			if(is_string($filter) || is_numeric($filter)) {

				if(preg_match('/\w+:\w+/',$filter)) {

					$entity = array_filter($this->collection,function ($entity) use($filter) {

						$search = explode(':', $filter);

						return preg_match("/{$search[1]}/i",$this->findType($entity, $search));
					});
				} else {

					return $this->collection[$filter];
				}

				return array_pop($entity);
			} else {

				throw new \Exception('invalid parameter provided');
			}
		}

		public function findType($entity, $search) {

			if(is_object($entity)) {

				if($entity instanceof \stdClass) {

					return $entity->{$search[0]};
				} else {

					return $entity->{'get'.$search[0]}();
				}
			} else {

				return $entity[$search[0]];
			}
		}

		public function get() {

			return $this->collection;
		}

		public function count() {

			return count($this->collection);
		}
	}