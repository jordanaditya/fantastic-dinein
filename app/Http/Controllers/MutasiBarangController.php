<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LabelSupplier\SupplierRecord;

class MutasiBarangController extends Controller
{
    public function index()
    {
        $supplierRecord = SupplierRecord::latest()->paginate(100);

        return view('mutasi-barang.record', compact('supplierRecord'));
    }
}
