<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    
    protected $guarded = ["id"];
    
    
    public function sender() {
        return $this->belongsTo(Accounts::class,"sender_account_id");
    }
    
    public function receiver() {
        return $this->belongsTo(Accounts::class,"receiver_account_id");
    }
}
