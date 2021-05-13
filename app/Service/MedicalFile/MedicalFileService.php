<?php


namespace App\Service\MedicalFile;


use App\Http\Requests\MedicalFile\MedicalFileRequest;
use App\Http\Requests\SocialMedia\SocialMediaRequest;
use App\Models\MedicalFile\MedicalFile;
use App\Models\SocialMedia\SocialMedia;
use App\Traits\GeneralTrait;

class MedicalFileService
{
    private $MedicalFileModel;
    use GeneralTrait;


    public function __construct(MedicalFile $medicalFile)
    {

        $this->MedicalFileModel=$medicalFile;
    }
    public function get()
    {

        $medicalFile=$this->MedicalFileModel::all();
        return $this->returnData('medicalFile',$medicalFile,'done');

    }

    public function getById($id)
    {

        $medicalFile= $this->MedicalFileModel::find($id);
        return $this->returnData('medicalFile',$medicalFile,'done');

    }

    public function getTrashed()
    {
        $medicalFile= $this->MedicalFileModel::IsActive()->get();
        return $this -> returnData('medicalFile',$medicalFile,'done');
    }
//-----------------------------------------------------------------------------------------------//
    public function create( MedicalFileRequest $request )
    {
        $medicalFile=new MedicalFile();

        $medicalFile->customer_id                  =$request->customer_id ;
        $medicalFile->file_number                  =$request->file_number;
        $medicalFile->file_date                    =$request->file_date;
        $medicalFile->review_date                  =$request->review_date;
        $medicalFile->PDF                          =$request->PDF;
        $medicalFile->doctor_id                    =$request->doctor_id;
        $medicalFile->is_active                    =$request->is_active;
        $medicalFile->is_approved                  =$request->is_approved;


        $result=$medicalFile->save();
        if ($result)
        {
            return $this->returnData('medicalFile', $medicalFile,'done');
        }
        else
        {
            return $this->returnError('400', 'saving failed');
        }

    }

    public function update(MedicalFileRequest $request,$id)
    {

        $medicalFile= $this->MedicalFileModel::find($id);

        $medicalFile->customer_id                  =$request->customer_id ;
        $medicalFile->file_number                  =$request->file_number;
        $medicalFile->file_date                    =$request->file_date;
        $medicalFile->review_date                  =$request->review_date;
        $medicalFile->PDF                          =$request->PDF;
        $medicalFile->doctor_id                    =$request->doctor_id;
        $medicalFile->is_active                    =$request->is_active;
        $medicalFile->is_approved                  =$request->is_approved;



        $result=$medicalFile->save();
        if ($result)
        {
            return $this->returnData('medicalFile', $medicalFile,'done');
        }
        else
        {
            return $this->returnError('400', 'updating failed');
        }

    }



    public function trash( $id)
    {
        $medicalFile= $this->MedicalFileModel::find($id);
        $medicalFile->is_active=false;
        $medicalFile->save();

        return $this->returnData('medicalFile', $medicalFile,'This medical File is trashed Now');
    }


    public function restoreTrashed( $id)
    {
        $medicalFile=MedicalFile::find($id);
        $medicalFile->is_active=true;
        $medicalFile->save();

        return $this->returnData('medicalFile', $medicalFile,'This medicalFile is trashed Now');
    }

    public function delete($id)
    {
        $medicalFile = MedicalFile::find($id);
        $medicalFile->is_active = false;
        $medicalFile->save();
        return $this->returnData('medicalFile', $medicalFile, 'This medicalFile is deleted Now');

    }
}
