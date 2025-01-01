<?php

use App\Http\Controllers\API\Attendance_user_controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/attendance_user',[Attendance_user_controller::class, 'get_attendance_user']);

Route::get('/machine_attendance_user',[Attendance_user_controller::class, 'machine_attendance_user']);
Route::get('/machine_attendance_list',[Attendance_user_controller::class, 'machine_attendance_list']);
Route::get('/device_data_clear_attendance',[Attendance_user_controller::class, 'device_data_clear_attendance']);

Route::get('/sync-attendance-users',[Attendance_user_controller::class, 'syncAttendanceUsers']);

Route::post('/add-attendance-user',[Attendance_user_controller::class, 'add_attendance_user']);
