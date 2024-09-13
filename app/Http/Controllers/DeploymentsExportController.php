<?php

namespace App\Http\Controllers;

use App\Exports\DeploymentExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DeploymentsExportController extends Controller
{
    public function export()
    {
        return Excel::download(new DeploymentExport, 'deployments.xlsx');
    }
}
