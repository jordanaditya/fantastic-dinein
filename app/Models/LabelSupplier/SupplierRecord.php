<?php

namespace App\Models\LabelSupplier;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierRecord extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'tbl_material_detail';
}
