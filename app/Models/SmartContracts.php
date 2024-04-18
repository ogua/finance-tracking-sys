<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmartContracts extends Model
{
    use HasFactory;
    
    protected $guarded = ["id"];
    
    public function buyer() {
        return $this->belongsTo(Parties::class,"buyer_id");
    }
    
    public function seller() {
        return $this->belongsTo(Parties::class,"seller_id");
    }
}
