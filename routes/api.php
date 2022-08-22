<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\IncomeController;
use App\Http\Controllers\Api\ApplicantController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\ApplicantIncomesController;
use App\Http\Controllers\Api\ApplicantTransactionsController;

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

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::get('/transactions', [
            TransactionController::class,
            'index',
        ])->name('transactions.index');
        Route::post('/transactions', [
            TransactionController::class,
            'store',
        ])->name('transactions.store');
        Route::get('/transactions/{transaction}', [
            TransactionController::class,
            'show',
        ])->name('transactions.show');
        Route::put('/transactions/{transaction}', [
            TransactionController::class,
            'update',
        ])->name('transactions.update');
        Route::delete('/transactions/{transaction}', [
            TransactionController::class,
            'destroy',
        ])->name('transactions.destroy');

        Route::get('/applicants', [ApplicantController::class, 'index'])->name(
            'applicants.index'
        );
        Route::post('/applicants', [ApplicantController::class, 'store'])->name(
            'applicants.store'
        );
        Route::get('/applicants/{applicant}', [
            ApplicantController::class,
            'show',
        ])->name('applicants.show');
        Route::put('/applicants/{applicant}', [
            ApplicantController::class,
            'update',
        ])->name('applicants.update');
        Route::delete('/applicants/{applicant}', [
            ApplicantController::class,
            'destroy',
        ])->name('applicants.destroy');

        // Applicant Incomes
        Route::get('/applicants/{applicant}/incomes', [
            ApplicantIncomesController::class,
            'index',
        ])->name('applicants.incomes.index');
        Route::post('/applicants/{applicant}/incomes', [
            ApplicantIncomesController::class,
            'store',
        ])->name('applicants.incomes.store');

        // Applicant Transactions
        Route::get('/applicants/{applicant}/transactions', [
            ApplicantTransactionsController::class,
            'index',
        ])->name('applicants.transactions.index');
        Route::post('/applicants/{applicant}/transactions', [
            ApplicantTransactionsController::class,
            'store',
        ])->name('applicants.transactions.store');

        Route::get('/orders', [OrderController::class, 'index'])->name(
            'orders.index'
        );
        Route::post('/orders', [OrderController::class, 'store'])->name(
            'orders.store'
        );
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name(
            'orders.show'
        );
        Route::put('/orders/{order}', [OrderController::class, 'update'])->name(
            'orders.update'
        );
        Route::delete('/orders/{order}', [
            OrderController::class,
            'destroy',
        ])->name('orders.destroy');
    });
