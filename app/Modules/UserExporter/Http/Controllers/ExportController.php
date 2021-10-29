<?php

namespace App\Modules\UserExporter\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    /**
     * Show the exporter page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        return view('UserExporter::show');
    }
}
