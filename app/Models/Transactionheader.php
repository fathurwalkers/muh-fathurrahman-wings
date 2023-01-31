<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Events\Login;

class Transactionheader extends Model
{
    use HasFactory;
    protected $table = "transaction_header";
    protected $guarded = [];
    protected $primaryKey = "id";

    public function login()
    {
        return $this->belongsTo(Login::class);
    }
}
