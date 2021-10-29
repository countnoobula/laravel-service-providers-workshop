<?php

namespace App\Modules\UserExporter\Adapters;

use App\Modules\UserExporter\Contracts\Adapter;

class XlsxAdapter implements Adapter {
	public function export() {
		return 'I ARE XLSX';
	}
}