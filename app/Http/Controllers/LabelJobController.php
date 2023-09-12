<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\LabelSupplier\SupplierRecord;

class LabelJobController extends Controller
{
    public function index()
    {
        $supplierRecords = SupplierRecord::latest()->take(100)->get();
        return view('label-job.record', compact('supplierRecords'));
    }
}
