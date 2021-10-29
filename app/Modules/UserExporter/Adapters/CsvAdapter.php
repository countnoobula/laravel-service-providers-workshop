<?php

namespace App\Modules\UserExporter\Adapters;

use App\Modules\UserExporter\Contracts\Adapter;

class CsvAdapter implements Adapter {
	public function export() {
		return 'I AM CSV';
	}
}