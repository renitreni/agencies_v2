<?php

namespace App\Http\Controllers;

use App\Exports\VouchersExport;
use Maatwebsite\Excel\Facades\Excel;

class VouchersExportController extends Controller
{
    public function export()
    {
        return Excel::download(new VouchersExport, 'vouchers.xlsx');
    }
}
