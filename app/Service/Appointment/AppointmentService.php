<?php


namespace App\Service\Appointment;


use App\Http\Requests\Appointment\AppointmentRequest;
use App\Models\Appointment\Appointment;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class AppointmentService
{
    private $AppointmentModel;
    use GeneralTrait;


    public function __construct(Appointment $appointment)
    {
        $this->AppointmentModel=$appointment;
    }
    public function get()
    {
        try
        {
        $appointment= $this->AppointmentModel::IsActive()->get();
        return $this->returnData('Appointment',$appointment,'done');
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400','faild');
        }
    }

    public function getById($id)
    {
        try
        {
        $appointment= $this->AppointmentModel::find($id);
            if (is_null($appointment) ){
        return $this->returnSuccessMessage('THis Appointment not found','done');
              }
            else{
            return  $this->returnData('appointment',$appointment,'done');
        }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400','faild');
        }
    }


    public function create( AppointmentRequest $request )
    {
        try {
                 $appointment=new Appointment();

                 $appointment->doctor_id                =$request->doctor_id;
                 $appointment->customer_id              =$request->customer_id ;
                 $appointment->start_date                =$request->start_date;
                 $appointment->end_date                  =$request->end_date;
                 $appointment->start_time                =$request->start_time;
                 $appointment->end_time                  =$request->end_time ;
                 $appointment->is_approved               =$request->is_approved;
                 $appointment->is_active                 =$request->is_active;


        $result=$appointment->save();
        if ($result)
        {
            return $this->returnData('Appointment', $appointment,'done');
        }
        else
        {
            return $this->returnError('400', 'saving failed');
        }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400', 'saving failed');
        }
    }

    public function update(AppointmentRequest $request,$id)
    {
        try {
                 $appointment= $this->AppointmentModel::find($id);

                 $appointment->doctor_id                 =$request->doctor_id;
                 $appointment->customer_id              =$request->customer_id ;
                 $appointment->start_date                =$request->start_date;
                 $appointment->end_date                  =$request->end_date;
                 $appointment->start_time                =$request->start_time;
                 $appointment->end_time                  =$request->end_time ;
                 $appointment->is_approved               =$request->is_approved;
                 $appointment->is_active                 =$request->is_active;

        $result=$appointment->save();
        if ($result)
        {
            return $this->returnData('Appointment', $appointment,'done');
        }
        else
        {
            return $this->returnError('400', 'updating failed');
        }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400', 'saving failed');
        }
    }

    public function trash( $id)
    {
        try {
            $appointment = $this->AppointmentModel::find($id);
            if (is_null($appointment)) {
                return $this->returnSuccessMessage('This Appointment not found', 'done');
            } else {
                $appointment->is_active = false;
                $appointment->save();
                return $this->returnData('Appointment', $appointment, 'This Appointment is trashed Now');
            }
        }
        catch (\Exception $ex)
        {
            return $this->returnError('400', 'faild');
        }
    }
    public function getTrashed()
    {
        try {
            $appointment= $this->AppointmentModel::NotActive()->get();
            return $this -> returnData('Appointment',$appointment,'done');
        }
        catch (\Exception $ex)
        {
            return $this->returnError('400', 'faild');
        }
    }


    public function restoreTrashed( $id)
    {
        try {
        $appointment=Appointment::find($id);
            if (is_null($appointment)) {
                return $this->returnSuccessMessage('This Appointment not found', 'done');
            } else {
              $appointment->is_active=true;
              $appointment->save();
              return $this->returnData('Appointment', $appointment,'This Appointment is trashed Now');
            }
        }
        catch (\Exception $ex)
        {
            return $this->returnError('400', 'faild');
        }
    }

    public function delete($id)
    {
        try {
        $appointment =Appointment::find($id);

            if ($appointment->is_active == 0) {
                $appointment = $this->AppointmentModel->destroy($id);
            }
            return $this->returnData('appointment', $appointment, 'This appointment Is deleted Now');

        } catch (\Exception $ex) {
            return $this->returnError('400', 'faild');
        }

    }
}
