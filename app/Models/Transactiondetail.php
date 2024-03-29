<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Transactiondetail extends Model
{
    use HasFactory;
    protected $table = "transaction_detail";
    protected $guarded = [];
    protected $primaryKey = "id";

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
