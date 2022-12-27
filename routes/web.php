<?php

use App\Models\User;
use App\Models\Monitoring;
use Illuminate\Http\Request;
use App\Models\RecentActivity;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\BtsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KuesionerController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\LandingpageController;
use App\Http\Controllers\DashboardProfileController;
use App\Http\Controllers\JawabanKuesionerController;
use App\Http\Controllers\KuesionerMonitoringController;

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

Route::get('/', [LandingpageController::class, 'index']);

Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/signup', [SignupController::class, 'index']);
Route::post('/signup', [SignupController::class, 'register']);

Route::get('/v/bts', [LandingpageController::class, 'view_bts']);
Route::get('/v/monitoring', [LandingpageController::class, 'view_monitoring']);
Route::get('/v/monitoring/{monitoring}/pertanyaan', [KuesionerMonitoringController::class, 'show_kuesioner']);
Route::get('/v/monitoring/{monitoring}', [KuesionerMonitoringController::class, 'view_kuesioner']);
Route::get('/v/maps', [LandingpageController::class, 'maps']);

// Add Kuesioner
Route::post('/v/monitoring', [KuesionerMonitoringController::class, 'store_monitoring']);
Route::put('/v/monitoring/{monitoring}', [KuesionerMonitoringController::class, 'edit_monitoring']);
Route::post('/v/monitoring/{monitoring}', [KuesionerMonitoringController::class, 'store_kuesioner']);

Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'index']);
    Route::get('/bts', [DashboardController::class, 'bts']);
    Route::get('/operator', [DashboardController::class, 'operator']);
    Route::get('/user', [DashboardController::class, 'user']);
    Route::get('/maps', [DashboardController::class, 'maps']);
    Route::get('/profile', [DashboardController::class, 'profile']);

    // Profile
    Route::get('/profile/{profile:id}', [DashboardProfileController::class, 'show']);
    Route::get('/profile/{profile:id}/edit', [DashboardProfileController::class, 'edit']);
    Route::post('/profile/{profile:id}/edit', [DashboardProfileController::class, 'update_profile']);
    Route::get('/profile/{profile:id}/change-password', [DashboardProfileController::class, 'change_password']);
    Route::post('/profile/{profile:id}/change-password', [DashboardProfileController::class, 'update_password']);
    Route::put('/user/{user}', [DashboardProfileController::class, 'edit_user']);
    Route::delete('/user/{user}', [DashboardProfileController::class, 'destroy']);

    // crud monitoring
    Route::resource('/monitoring', MonitoringController::class)->except('update');
    Route::put('/monitoring', function (Request $request) {
        $validatedData = $request->validate([
            'tahun' => 'required|min:4|max:4',
            'bts_id' => 'required',
            'tgl_kunjungan' => 'required',
            'kondisi_bts_id' => 'required',
            'user_surveyor_id' => 'required'
        ]);

        $validatedData['edited_by'] = auth()->user()->id;
        Monitoring::where('id', $request->id)->update($validatedData);

        // Record activity
        $bts = DB::select("select nama from bts where id = $request->bts_id");
        $activity = [
            'user_id' => auth()->user()->id,
            'action' => 'edit',
            'object' => 'monitoring on ' . $bts[0]->nama
        ];

        RecentActivity::create($activity);

        return redirect('/monitoring')->with('success', 'Data updated!');
    });

    // CRUD Kuesioner
    Route::get('/kuesioner', [DashboardController::class, 'kuesioner']);
    Route::resource('/kuesioner', KuesionerController::class)->except('index');

    // CRUD Jawaban Kuesioner
    Route::post('/jawabankuesioner', [JawabanKuesionerController::class, 'store']);
    Route::put('/jawabankuesioner/{jawabankuesioner:id}', [JawabanKuesionerController::class, 'update']);
    Route::delete('/jawabankuesioner/{jawabankuesioner:id}', [JawabanKuesionerController::class, 'destroy']);

    // CRUD BTS
    Route::resource('/bts', BtsController::class)->except('index');

    
});

// API
Route::get('/api/chart', [ApiController::class, 'chart']);
Route::get('/api/monitoring/{id}', [ApiController::class, 'monitoring_data']);
Route::get('/api/kuesioner/{id}', [ApiController::class, 'kuesioner_data']);
Route::get('/api/jawabankuesioner/{id}', [ApiController::class, 'jawaban_kuesioner_data']);
Route::get('/api/locations', [ApiController::class, 'locations']);
Route::get('/api/bts/{id}', [ApiController::class, 'bts']);
Route::get('/api/user/{id}', [ApiController::class, 'user']);