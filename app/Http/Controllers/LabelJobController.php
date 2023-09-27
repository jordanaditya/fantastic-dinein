<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Maestroerror\HeicToJpg;
use App\Models\LabelSupplier\SupplierRecord;
use Illuminate\Http\Request;

class LabelJobController extends Controller
{
    public function index()
    {
        $supplierRecords = SupplierRecord::latest()->take(100)->get();
        return view('label-job.record', compact('supplierRecords'));
    }

    public function job(Request $request)
    {
        $query = SupplierRecord::latest();

        // Periksa apakah permintaan kosong
        if ($request->ajax() && $request->has('start_date') && $request->has('end_date')) {
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');

            // Periksa jika start_date dan end_date sama, tambahkan atau kurangkan satu hari dari end_date
            if ($start_date === $end_date) {
                $end_date = date('Y-m-d', strtotime($end_date . ' +1 day'));
            }

            $query->whereBetween('created_at', [$start_date, $end_date]);
        } else {
            // Jika permintaan kosong, set tanggal awal dan akhir ke hari ini
            $today = now()->format('Y-m-d');
            $query->whereDate('created_at', $today);
        }

        $supplierRecords = $query->get();

        return response()->json(['data' => $supplierRecords]);
    }
}
