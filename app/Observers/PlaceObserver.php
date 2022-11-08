<?php

namespace App\Observers;

use App\Models\Place;
use Illuminate\Support\Facades\Cache;

class PlaceObserver
{
    /**
     * Handle the Place "created" event.
     *
     * @param  \App\Models\Place  $place
     * @return void
     */
    public function created(Place $place)
    {
        Cache::forget('places');
    }

    /**
     * Handle the Place "updated" event.
     *
     * @param  \App\Models\Place  $place
     * @return void
     */
    public function updated(Place $place)
    {
        Cache::forget('places');
    }

    /**
     * Handle the Place "deleted" event.
     *
     * @param  \App\Models\Place  $place
     * @return void
     */
    public function deleted(Place $place)
    {
        Cache::forget('places');
    }

    /**
     * Handle the Place "restored" event.
     *
     * @param  \App\Models\Place  $place
     * @return void
     */
    public function restored(Place $place)
    {
        Cache::forget('places');
    }

    /**
     * Handle the Place "force deleted" event.
     *
     * @param  \App\Models\Place  $place
     * @return void
     */
    public function forceDeleted(Place $place)
    {
        Cache::forget('places');
    }
}
