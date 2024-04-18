<?php

namespace App\Models;

use App\Observers\AssetsObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy([AssetsObserver::class])]
class Assets extends Model
{
    use HasFactory;
    
    protected $guarded = ["id"];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,"user_id");
    }
    
    public function createduser(): BelongsTo
    {
        return $this->belongsTo(User::class,"created_by");
    }
    
    public function editeduser(): BelongsTo
    {
        return $this->belongsTo(User::class,"edited_by");
    }
}
