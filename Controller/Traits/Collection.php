<?php

	namespace Controller\Traits;

	use Controller\Interfaces\BuilderInterface;

	trait Collection
	{
		protected $collection = [];

		public function add($entities, BuilderInterface $factory = null, $type = null) {
			if(is_array($entities)) {

				foreach($entities as $entity) {

					array_push($this->collection,$factory::{'make'}($type, $entity));
				}
			} else {

				$this->add([$entities], $factory, $type);
			}
		}

		public function find($filter) {

			if(is_string($filter) && !preg_match('/\w+:w+/',$filter)) {

				$entity = array_filter($this->collection,function ($entity) use($filter) {

					$search = explode(':', $filter);

					return preg_match("/{$search[1]}/i",!is_array($entity) ? $entity->{'get'.$search[0]}() : $entity[$search[0]]);
				});

				return array_pop($entity);
			} else {

				throw new \Exception('invalid parameter provided');
			}
		}

		public function get() {

			return $this->collection;
		}

		public function count() {

			return count($this->collection);
		}
	}