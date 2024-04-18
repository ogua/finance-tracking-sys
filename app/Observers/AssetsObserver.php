<?php

namespace App\Observers;

use App\Models\Assets;

class AssetsObserver
{
    /**
    * Handle the Assets "created" event.
    */
    public function created(Assets $assets): void
    {
        $assets->created_by = auth()->user()->id;
        $assets->save();
    }
    
    /**
    * Handle the Assets "updated" event.
    */
    public function updated(Assets $assets): void
    {
        $assets->edited_by = auth()->user()->id;
        $assets->save();
    }
    
    /**
    * Handle the Assets "deleted" event.
    */
    public function deleted(Assets $assets): void
    {
        //
    }
    
    /**
    * Handle the Assets "restored" event.
    */
    public function restored(Assets $assets): void
    {
        //
    }
    
    /**
    * Handle the Assets "force deleted" event.
    */
    public function forceDeleted(Assets $assets): void
    {
        //
    }
}
