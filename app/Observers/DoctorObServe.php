<?php

namespace App\Observers;

use App\Models\Doctors\doctor;

class DoctorObServe
{
    /**
     * Handle the doctor "created" event.
     *
     * @param  \App\Models\Doctors\doctor  $doctor
     * @return void
     */
    public function created(doctor $doctor)
    {
        //
    }

    /**
     * Handle the doctor "updated" event.
     *
     * @param  \App\Models\Doctors\doctor  $doctor
     * @return void
     */
    public function updated(doctor $doctor)
    {
        //
    }

    /**
     * Handle the doctor "deleted" event.
     *
     * @param  \App\Models\Doctors\doctor  $doctor
     * @return void
     */
    public function deleted(doctor $doctor)
    {
        //
    }

    /**
     * Handle the doctor "restored" event.
     *
     * @param  \App\Models\Doctors\doctor  $doctor
     * @return void
     */
    public function restored(doctor $doctor)
    {
        //
    }

    /**
     * Handle the doctor "force deleted" event.
     *
     * @param  \App\Models\Doctors\doctor  $doctor
     * @return void
     */
    public function forceDeleted(doctor $doctor)
    {
       $doctor->doctorTranslation->delete();
    }
}
