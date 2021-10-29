<?php

namespace App\Modules\UserExporter\Exceptions;

use Exception;

class AdapterNotFoundException extends Exception
{
    public function __construct($type) {
        parent::__construct(sprintf('Adapter %s not found', $type));
    }
}
