<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    
    protected $guarded = ["id"];
    
    public function extype()
    {
        return $this->belongsTo(Expensetypes::class,"expensetype_id");
    }
    
    public function vendor()
    {
        return $this->belongsTo(Vendors::class,"vendor_id");
    }
}
