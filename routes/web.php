<?php

use App\Http\Controllers\DeploymentsExportController;
use App\Http\Controllers\VouchersExportController;
use App\Livewire\AgencyLivewire;
use App\Livewire\ApplicantDocsLivewire;
use App\Livewire\ApplicantsLivewire;
use App\Livewire\ApplicationFromLivewire;
use App\Livewire\CasesLivewire;
use App\Livewire\ComplaintFormLivewire;
use App\Livewire\DashboardLivewire;
use App\Livewire\DeploymentLivewire;
use App\Livewire\DepriveLivewire;
use App\Livewire\Login;
use App\Livewire\MapLivewire;
use App\Livewire\OFWMonitoringLivewire;
use App\Livewire\Reporting;
use App\Livewire\ReportLivewire;
use App\Livewire\RescueRemoteLivewire;
use App\Livewire\RescuesLivewire;
use App\Livewire\Users;
use App\Livewire\VoucherLivewire;
use App\Livewire\VoucherV2Livewire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('vouchers/export', [VouchersExportController::class, 'export'])->name('vouchers.export-excel');
Route::get('deployments/export', [DeploymentsExportController::class, 'export'])->name('deployments.export-excel');
// Route::get('deployments/export', [DeploymentLivewire::class, 'export'])->name('deployments.export-excel');

Route::get('/login', Login::class)->name('login');
Route::post(
    '/logout',
    function () {
        $agency = Auth::user()->agency_id;
        Auth::logout();

        return redirect()->route('login', ['agency' => $agency]);
    }
)->name('logout');

Route::get('report', Reporting::class)->name('reporting');
Route::get('rescue-report', RescueRemoteLivewire::class)->name('rescue');
Route::get('complaint', ComplaintFormLivewire::class)->name('complaint-form-livewire');

Route::middleware(['auth'])->group(function () {
    Route::get('/', DashboardLivewire::class)->name('dashboard');

    Route::get('/applicant/form', ApplicationFromLivewire::class)->name('applicant.form');
    Route::get('/applicant/docs', ApplicantDocsLivewire::class)->name('applicant-docs-livewire');

    Route::middleware(['can:agency'])->group(function () {
        Route::get('/vouchers', VoucherLivewire::class)->name('finance.vouchers');
        Route::get('/vouchers-v2', VoucherV2Livewire::class)->name('finance.vouchers-v2');
        Route::get('/applicants', ApplicantsLivewire::class)->name('applicants');
        Route::get('/deployments', DeploymentLivewire::class)->name('deployments');
    });

    Route::middleware(['can:admin'])->group(callback: function () {
        Route::get('/users', Users::class)->name('users');
        Route::get('/cases', CasesLivewire::class)->name('cases');
        Route::get('/reports', ReportLivewire::class)->name('report');
        Route::get('/mapview', MapLivewire::class)->name('map');
        Route::get('/rescues', RescuesLivewire::class)->name('rescues');
        Route::get('/agencies', AgencyLivewire::class)->name('agencies');
        Route::get('/ofw-monitoring', OFWMonitoringLivewire::class)->name('ofw.monitoring');
        Route::get('/deprive', DepriveLivewire::class)->name('deprive');
    });
});
