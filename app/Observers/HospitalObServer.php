<?php

namespace App\Observers;

use App\Models\Hospital\Hospital;

class HospitalObServer
{
    /**
     * Handle the Hospital "created" event.
     *
     * @param  \App\Models\Hospital\Hospital  $hospital
     * @return void
     */
    public function created(Hospital $hospital)
    {
        //
    }

    /**
     * Handle the Hospital "updated" event.
     *
     * @param  \App\Models\Hospital\Hospital  $hospital
     * @return void
     */
    public function updated(Hospital $hospital)
    {
        //
    }

    /**
     * Handle the Hospital "deleted" event.
     *
     * @param  \App\Models\Hospital\Hospital  $hospital
     * @return void
     */
    public function deleted(Hospital $hospital)
    {
        //
    }

    /**
     * Handle the Hospital "restored" event.
     *
     * @param  \App\Models\Hospital\Hospital  $hospital
     * @return void
     */
    public function restored(Hospital $hospital)
    {
        //
    }

    /**
     * Handle the Hospital "force deleted" event.
     *
     * @param  \App\Models\Hospital\Hospital  $hospital
     * @return void
     */
    public function forceDeleted(Hospital $hospital)
    {
       $hospital->HospitalTranslation()->delete();
    }
}
