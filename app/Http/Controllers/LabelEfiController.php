<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\LabelSupplier\SupplierRecord;

class LabelEfiController extends Controller
{
    public function index()
    {
        $supplierRecord = SupplierRecord::latest()->paginate(100);
        return view('label-efi.record', compact('supplierRecord'));
    }
}
