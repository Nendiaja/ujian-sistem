<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpsiController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\RulesController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\ApproveController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserNilaiController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserRequestController;
use App\Http\Controllers\BussinesUnitController;
use App\Http\Controllers\RequestUjianController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\SoalByKategoriController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login.index');
});

Route::resource('/login', LoginController::class)->only('create', 'index', 'store');


Route::group(['prefix' => '/admin', 'as' => 'admin.', 'middleware' => ['admin', 'auth.redirect']], function () {

    Route::resource('/dashboard', DashboardController::class);

    Route::resource('/kategori', KategoriController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/pic', AdminController::class);
    Route::resource('/soal', SoalController::class);
    Route::resource('/soalByKategori', SoalByKategoriController::class);
    Route::resource('/opsi', OpsiController::class);
    Route::resource('/request', RequestUjianController::class);
    Route::resource('/announcement', SettingController::class);
    Route::resource('/rules', RulesController::class);
    Route::resource('/rules', RulesController::class);
    Route::resource('/bussinesUnit', BussinesUnitController::class);
    Route::resource('/department', DepartmentController::class);
});


Route::prefix('admin')->group(function () {
    Route::get('request/approve/{id}', [RequestController::class, 'approve'])->name('admin.request.approve');
    Route::get('/user/{id}/printpdf', [UserController::class, 'printPDF'])->name('user.printpdf');
    Route::get('/user/edit_user/{id}', [UserController::class, 'editUser'])->name('admin.user.user_edit');
    Route::put('/user/{id}/update_kategori_user', [UserController::class, 'update_kategori_user'])->name('admin.user.update_kategori_user');
});

Route::get('/user/export-users', [UserController::class, 'exportExcel'])->name('user.exportExcel');


Route::group(['prefix' => '/user', 'as' => 'user.', 'middleware' => ['user', 'auth.redirect']], function () {

    Route::resource('/dashboard', UserDashboardController::class);
    Route::resource('/ujian', UjianController::class);
    Route::resource('/nilai', UserNilaiController::class);
    Route::resource('/request', UserRequestController::class);
    Route::resource('/profile', ProfileController::class);
    Route::put('/update-password/{id}', [ProfileController::class, 'updatePasswordBaru'])->name('updatePasswordBaru');
});

Route::get('/visitor/dashboard', [VisitorController::class, 'index'])->name('visitor.dashboard.index');


