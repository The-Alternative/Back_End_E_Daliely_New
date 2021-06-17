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
        try {
            $medicalFile = $this->MedicalFileModel::IsActive()->get();
            return $this->returnData('medicalFile', $medicalFile, 'done');
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    public function getById($id)
    {
        try {
        $medicalFile= $this->MedicalFileModel::find($id);
            if (is_null($medicalFile)){
                return $this->returnSuccessMessage('this Medical file not found','done');
            }
            else{
                return $this->returnData('medicalFile',$medicalFile,'done');
            }
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }

    public function create( MedicalFileRequest $request )
    {
        try{
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
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    public function update(MedicalFileRequest $request,$id)
    {
        try{
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
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    public function trash( $id)
    {
        try{
        $medicalFile= $this->MedicalFileModel::find($id);
            if (is_null($medicalFile)) {
                return $this->returnSuccessMessage('This Medical file not found', 'done');
            }
            else
            {
                $medicalFile->is_active=0;
                $medicalFile->save();
                return $this->returnData('medicalFile', $medicalFile,'This medical File is trashed Now');
            }
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    public function getTrashed()
    {
        try{
              $medicalFile= $this->MedicalFileModel::NotActive()->get();
            return $this -> returnData('medicalFile',$medicalFile,'done');
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    public function restoreTrashed( $id)
    {
        try{
        $medicalFile=MedicalFile::find($id);
            if (is_null($medicalFile)) {
                return $this->returnSuccessMessage('This Medical file not found', 'done');
            }
            else
            {
                $medicalFile->is_active=1;
                $medicalFile->save();
                return $this->returnData('medicalFile', $medicalFile,'This medical File is trashed Now');
            }
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }

    }
    public function delete($id)
    {
        try{
        $medicalFile = MedicalFile::find($id);
            if ($medicalFile->is_active == 0) {
                $medicalFile = $this->MedicalFileModel->destroy($id);

            return $this->returnSuccessMessage('medical File', 'This medical File is deleted Now');
            }
            else{
                return $this->returnData('medical File', $id, 'This medical File can not deleted');

            }
        }
        catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
}
