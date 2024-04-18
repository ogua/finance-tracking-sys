<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    
    protected $guarded = ["id"];
    
    public function asset() {
        return $this->belongsTo(Assets::class,"asset_id");
    }
}
