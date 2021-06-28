<?php

namespace App\Observers;

use App\Models\Specialty\Specialty;

class SpecialtyObServer
{
    /**
     * Handle the Specialty "created" event.
     *
     * @param  \App\Models\Specialty\Specialty  $specialty
     * @return void
     */
    public function created(Specialty $specialty)
    {
        //
    }

    /**
     * Handle the Specialty "updated" event.
     *
     * @param  \App\Models\Specialty\Specialty  $specialty
     * @return void
     */
    public function updated(Specialty $specialty)
    {
        //
    }

    /**
     * Handle the Specialty "deleted" event.
     *
     * @param  \App\Models\Specialty\Specialty  $specialty
     * @return void
     */
    public function deleted(Specialty $specialty)
    {
        //
    }

    /**
     * Handle the Specialty "restored" event.
     *
     * @param  \App\Models\Specialty\Specialty  $specialty
     * @return void
     */
    public function restored(Specialty $specialty)
    {
        //
    }

    /**
     * Handle the Specialty "force deleted" event.
     *
     * @param  \App\Models\Specialty\Specialty  $specialty
     * @return void
     */
    public function forceDeleted(Specialty $specialty)
    {
     $specialty->specialtyTranslation->delete();
    }
}
