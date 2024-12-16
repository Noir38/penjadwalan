<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DailyscheduleController;
use App\Http\Controllers\DataAngkatanController;
use App\Http\Controllers\DataKelasController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\HariController;
use App\Http\Controllers\MatakuliahController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/change-password', [AuthController::class, 'changePassword']);
Route::post('login', [AuthController::class,'login']);
Route::post('register', [AuthController::class,'register']);
Route::get('user/{id}', [AuthController::class, 'getById']);
Route::middleware('auth:sanctum')->get('user-data', [AuthController::class, 'getUserData']);


Route::group(['middleware'=>'api'],function(){
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);
});


Route::get('dosen', [DosenController::class, 'index']);
Route::post('addnew', [DosenController::class, 'store']);
Route::put('dosen/{id}', [DosenController::class, 'show']);
Route::put('dosenupdate/{id}', [DosenController::class, 'update']);
Route::delete('dosendelete/{id}', [DosenController::class, 'destroy']);

Route::get('kelas', [DataKelasController::class, 'index']);
Route::post('addkelas', [DataKelasController::class, 'store']);
Route::put('kelas/{id}', [DataKelasController::class, 'show']);
Route::put('kelasupdate/{id}', [DataKelasController::class, 'update']);
Route::delete('kelasdelete/{id}', [DataKelasController::class, 'destroy']);

Route::get('angkatan', [DataAngkatanController::class, 'index']);
Route::post('addangkatan', [DataAngkatanController::class, 'store']);
Route::put('angkatan/{id}', [DataAngkatanController::class, 'show']);
Route::put('angkatanupdate/{id}', [DataAngkatanController::class, 'update']);
Route::delete('angkatandelete/{id}', [DataAngkatanController::class, 'destroy']);

Route::get('hari', [HariController::class, 'index']);
Route::post('addhari', [HariController::class, 'store']);
Route::put('hari/{id}', [HariController::class, 'show']);
Route::put('hariupdate/{id}', [HariController::class, 'update']);
Route::delete('haridelete/{id}', [HariController::class, 'destroy']);

Route::get('matakuliah', [MatakuliahController::class, 'index']);
Route::post('addmatakuliah', [MatakuliahController::class, 'store']);
Route::put('matakuliah/{id}', [MatakuliahController::class, 'show']);
Route::put('matakuliahupdate/{id}', [MatakuliahController::class, 'update']);
Route::delete('matakuliahdelete/{id}', [MatakuliahController::class, 'destroy']);
 
Route::get('daily', [DailyscheduleController::class, 'index']);
Route::post('adddaily', [DailyscheduleController::class, 'store']);
Route::put('daily/{id}', [DailyscheduleController::class, 'show']);
Route::put('dailyupdate/{id}', [DailyscheduleController::class, 'update']);
Route::delete('dailydelete/{id}', [DailyscheduleController::class, 'destroy']);


// Route::middleware(['cors'])->group(function () {
//     Route::get('/dailyschedule', [DailyscheduleController::class, 'index']);
//     Route::post('/dailyschedule', [DailyscheduleController::class, 'store']);
  
// });
