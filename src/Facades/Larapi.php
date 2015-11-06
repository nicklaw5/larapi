<?php 

namespace Nicklaw5\Larapi\Facades;

use Illuminate\Support\Facades\Facade;

class Larapi extends Facade {

	/**
	 * Get the registered name of the component
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'larapi'; }
}