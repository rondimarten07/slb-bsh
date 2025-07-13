<?php

use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

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


Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('blog', [PageController::class, 'blog'])->name('blog');
Route::get('faq', [PageController::class, 'faq'])->name('faq');
Route::get('blog/{slug}', [PageController::class, 'blogview'])->name('blog.view');
Route::get('/presence/pdf', [PDFController::class, 'generatePDF'])->name('attendance.pdf');
Route::get('/report/pdf/{id}', [PDFController::class, 'generateReportPDF'])->name('studentreport.pdf');
Route::get('/paycheck/pdf', [PDFController::class, 'generatePaycheckPDF'])->name('paycheck.pdf');
