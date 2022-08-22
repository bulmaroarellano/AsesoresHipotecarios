<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\TransactionController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::get('transactions', [
            TransactionController::class,
            'index',
        ])->name('transactions.index');
        Route::post('transactions', [
            TransactionController::class,
            'store',
        ])->name('transactions.store');
        Route::get('transactions/create', [
            TransactionController::class,
            'create',
        ])->name('transactions.create');
        Route::get('transactions/{transaction}', [
            TransactionController::class,
            'show',
        ])->name('transactions.show');
        Route::get('transactions/{transaction}/edit', [
            TransactionController::class,
            'edit',
        ])->name('transactions.edit');
        Route::put('transactions/{transaction}', [
            TransactionController::class,
            'update',
        ])->name('transactions.update');
        Route::delete('transactions/{transaction}', [
            TransactionController::class,
            'destroy',
        ])->name('transactions.destroy');

        Route::get('applicants', [ApplicantController::class, 'index'])->name(
            'applicants.index'
        );
        Route::post('applicants', [ApplicantController::class, 'store'])->name(
            'applicants.store'
        );
        Route::get('applicants/create', [
            ApplicantController::class,
            'create',
        ])->name('applicants.create');
        Route::get('applicants/{applicant}', [
            ApplicantController::class,
            'show',
        ])->name('applicants.show');
        Route::get('applicants/{applicant}/edit', [
            ApplicantController::class,
            'edit',
        ])->name('applicants.edit');
        Route::put('applicants/{applicant}', [
            ApplicantController::class,
            'update',
        ])->name('applicants.update');
        Route::delete('applicants/{applicant}', [
            ApplicantController::class,
            'destroy',
        ])->name('applicants.destroy');

        Route::get('orders', [OrderController::class, 'index'])->name(
            'orders.index'
        );
        Route::post('orders', [OrderController::class, 'store'])->name(
            'orders.store'
        );
        Route::get('orders/create', [OrderController::class, 'create'])->name(
            'orders.create'
        );
        Route::get('orders/{order}', [OrderController::class, 'show'])->name(
            'orders.show'
        );
        Route::get('orders/{order}/edit', [
            OrderController::class,
            'edit',
        ])->name('orders.edit');
        Route::put('orders/{order}', [OrderController::class, 'update'])->name(
            'orders.update'
        );
        Route::delete('orders/{order}', [
            OrderController::class,
            'destroy',
        ])->name('orders.destroy');
    });
