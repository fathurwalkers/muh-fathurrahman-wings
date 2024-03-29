<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transactiondetail;

class Product extends Model
{
    use HasFactory;
    protected $table = "product";
    protected $guarded = [];
    protected $primaryKey = "id";

    public function transaction_detail()
    {
        return $this->hasMany(Transactiondetail::class);
    }
}
