<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LabelSupplier\SupplierRecord;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LabelSupplierController extends Controller
{
    public function index(Request $request)
    {
        $supplierCategories = SupplierRecord::whereDate('created_at', Carbon::today())->distinct()->get(['paper_type']);
        return view('label-supplier.record', compact('supplierCategories'));
    }

    public function tabelStockCodes(Request $request)
    {
        $paperType = $request->input('paper_type');
        $supplierStockCodes = SupplierRecord::where('paper_type', $paperType)
            ->whereDate('created_at', Carbon::today())
            ->select('stock_code',  DB::raw('MAX(created_at) AS created_at'), 'supplier_name', 'material_desc',  DB::raw('Count(barcode_material) as barcode_qty'))
            ->groupBy('stock_code', 'supplier_name', 'material_desc')
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json([
            'status' => 'success',
            'data' => $supplierStockCodes,
            'message' => 'Information saved successfully!'
        ], 200);
    }

    public function tabelBarcodes(Request $request)
    {
        $stockCodes = $request->input('stock_code');
        $supplierBarcodes = SupplierRecord::where('stock_code', $stockCodes)
            ->whereDate('created_at', Carbon::today())
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json([
            'status' => 'success',
            'data' => $supplierBarcodes,
            'message' => 'Information saved successfully!'
        ], 200);
    }
}
