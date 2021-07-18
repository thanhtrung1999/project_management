<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
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

Route::get('', function () {
    return redirect('student/login');
})->middleware('checkLogout');

Route::get('{role}/login', [AuthController::class, 'getViewLogin'])->middleware('checkLogout')->name('login');
Route::post('{role}/login', [AuthController::class, 'executeLogin']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'admin', 'middleware' => 'checkLogin'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('accounts', AccountController::class);
});

Route::group(['prefix' => 'student', 'middleware' => 'checkLogin'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('student.dashboard');
    Route::prefix('projects')->group(function () {
        Route::get('/', [ProjectController::class, 'getListProjects'])->name('student.projects.index');
        Route::get('/create', [ProjectController::class, 'getFormCreate'])->name('student.projects.form-create');
        Route::post('/create', [ProjectController::class, 'store'])->name('student.project.create');
        Route::get('/{project}', [ProjectController::class, 'showProject'])->name('student.project.detail');
        Route::get('/{project}/edit', [ProjectController::class, 'getFormUpdate'])->name('student.project.edit');
        Route::put('/{project}', [ProjectController::class, 'update'])->name('student.project.update');
        Route::delete('/{document}', [ProjectController::class, 'deleteFile'])->name('student.document.delete');
    });
});

Route::group(['prefix' => 'teacher', 'middleware' => 'checkLogin'], function () {
    Route::get('', [DashboardController::class, 'index'])->name('teacher.dashboard');
    Route::prefix('projects')->group(function () {
        Route::get('/', [ProjectController::class, 'getListProjectsOfStudents'])->name('teacher.projects.index');
        Route::get('/{project}', [ProjectController::class, 'showProjectOfStudent'])->name('teacher.project.detail');
    });
    Route::get('download-document/{document}', [ProjectController::class, 'download'])
        ->name('teacher.document.download');
});
