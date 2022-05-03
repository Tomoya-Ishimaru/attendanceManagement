<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OwnerController\ResourceController;
use App\Http\Controllers\AdminController\OwnersController;
use App\Http\Controllers\OwnerController\Auth\OwnerLoginController;
use App\Http\Controllers\AdminController\Auth\LoginController;
use App\Http\Controllers\TimeController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [TimeController::class, 'index'])->name('dashboard');
    Route::get('/in', [TimeController::class, 'punchIn'])->name('punchIn');
    Route::get('/out', [TimeController::class, 'punchOut'])->name('punchOut');
    Route::get('/modify', [TimeController::class, 'punchEdit'])->name('modify');
    Route::post('/punchupdata', [TimeController::class, 'punchUpdata'])->name('punchUpdata');
});

Route::prefix('admin')->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('admin.login');
    Route::post('login', [LoginController::class, 'store'])->name('admin.login');

    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [OwnersController::class, 'index']);
        Route::resource('owners', OwnersController::class)->middleware('auth:admin')->except(['show']);
    });

    
    
    Route::prefix('expired-owners')->
        middleware('auth:admin')->group(function(){
            Route::get('index', [OwnersController::class, 'expiredOwnerIndex'])->name('expired-owners.index');
            Route::post('destroy/{owner}', [OwnersController::class, 'expiredOwnerDestroy'])->name('expired-owners.destroy');
});
});

Route::prefix('owner')->group(function () {
    Route::get('login', [OwnerLoginController::class, 'create'])->name('owner.login');
   
    Route::post('login', [OwnerLoginController::class, 'store'])->name('owner.login');
    Route::middleware('auth:owner')->group(function () {
        Route::get('dashboard', [ResourceController::class, 'index'])->name('owner.dashboard');
    });
});
