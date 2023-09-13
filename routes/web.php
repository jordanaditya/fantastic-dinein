<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('layouts.index');
});
Route::get('/label-supplier/record', [App\Http\Controllers\LabelSupplierController::class, 'index']);
Route::get('/label-supplier/record/get-stockcode', [App\Http\Controllers\LabelSupplierController::class, 'tabelStockCodes']);
Route::get('/label-supplier/record/get-barcode', [App\Http\Controllers\LabelSupplierController::class, 'tabelBarcodes']);

Route::get('/label-job/record', [App\Http\Controllers\LabelJobController::class, 'index']);
Route::get('/mutasi-barang/record', [App\Http\Controllers\MutasiBarangController::class, 'index']);
Route::get('/label-efi/record', [App\Http\Controllers\LabelEfiController::class, 'index']);
