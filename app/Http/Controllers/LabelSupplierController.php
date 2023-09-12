<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LabelSupplier\SupplierRecord;

class LabelSupplierController extends Controller
{
    public function index(Request $request) {
        $supplierRecords = SupplierRecord::latest()->take(100)->get();
        return view('label-supplier.record', compact('supplierRecords'));
    }
}
