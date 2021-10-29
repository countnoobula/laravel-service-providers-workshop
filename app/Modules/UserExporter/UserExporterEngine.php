<?php

namespace App\Modules\UserExporter;

use App\Modules\UserExporter\Contracts\Adapter;
use App\Modules\UserExporter\Exceptions\AdapterNotFoundException;

class UserExporterEngine {

	const TYPE_CSV = 'csv';
	const TYPE_XLSX = 'xlsx';

	public static $adapters_map = [
		self::TYPE_CSV => Adapters\CsvAdapter::class,
		// self::TYPE_XLSX => Adapters\XlsxAdapter::class,
	];

	public function ofType($type): Adapter {
		if (!array_key_exists($type, self::$adapters_map)) {
			throw new AdapterNotFoundException($type);
		}

		return new self::$adapters_map[$type]();
	}
	
}