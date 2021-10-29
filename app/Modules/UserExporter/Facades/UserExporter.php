<?php

namespace App\Modules\UserExporter\Facades;

use Illuminate\Support\Facades\Facade;

class UserExporter extends Facade {
	
	protected static function getFacadeAccessor() {
		return 'user-exporter';
	}
}