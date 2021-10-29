<?php

namespace App\Modules\UserExporter\Contracts;

use App\Modules\UserExporter\Contracts;

interface Adapter {

	public function export();
}