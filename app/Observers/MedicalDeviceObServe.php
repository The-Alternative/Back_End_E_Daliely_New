<?php

namespace App\Observers;

use App\Models\medicaldevice\medicaldevice;

class MedicalDeviceObServe
{
    /**
     * Handle the medicaldevice "created" event.
     *
     * @param  \App\Models\medicaldevice\medicaldevice  $medicaldevice
     * @return void
     */
    public function created(medicaldevice $medicaldevice)
    {
        //
    }

    /**
     * Handle the medicaldevice "updated" event.
     *
     * @param  \App\Models\medicaldevice\medicaldevice  $medicaldevice
     * @return void
     */
    public function updated(medicaldevice $medicaldevice)
    {
        //
    }

    /**
     * Handle the medicaldevice "deleted" event.
     *
     * @param  \App\Models\medicaldevice\medicaldevice  $medicaldevice
     * @return void
     */
    public function deleted(medicaldevice $medicaldevice)
    {
        //
    }

    /**
     * Handle the medicaldevice "restored" event.
     *
     * @param  \App\Models\medicaldevice\medicaldevice  $medicaldevice
     * @return void
     */
    public function restored(medicaldevice $medicaldevice)
    {
        //
    }

    /**
     * Handle the medicaldevice "force deleted" event.
     *
     * @param  \App\Models\medicaldevice\medicaldevice  $medicaldevice
     * @return void
     */
    public function forceDeleted(medicaldevice $medicaldevice)
    {
      $medicaldevice->medicaldeviceTranslation->delete();
    }
}
