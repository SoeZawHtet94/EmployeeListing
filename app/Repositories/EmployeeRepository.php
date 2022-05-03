<?php

namespace App\Repositories;

use App\Repositories\Interfaces\EmployeeInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\Employee;

class EmployeeRepository implements EmployeeInterface 
{

    public function EmployeeRegister($employeeData){
        $message = "";
        # check email is already exist
        $checkEmail = DB::table('employees')->where('email', $employeeData['email'])->first();
        if(empty($checkEmail)){
            try{
                Employee::insert([
                    "name"              => $employeeData['name'],
                    "email"             => $employeeData['email'],
                    "date_of_birth"     => $employeeData['dateofbirth'],
                    "phone_no"          => $employeeData['phno'],
                    "nrc_no"            => $employeeData['nrcno'],
                    "address"           => $employeeData['address'],
                    "gender"            => $employeeData['gender'],
                    "maritual_status"   => $employeeData['maritualstatus'],
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now()
                    ]);
                    $message = "Save successfully";
                    return $message;	
            }catch (Throwable $e) {
                Log::channel('debuglog')->debug($e->getMessage(). 'Fail to save data in emplyee table!');
                $message = "Fail to save!";
                return $message;	
            } 
        } else {
            $message = "Email is already exist!";
            return $message;
        }
    }

    public function EmployeeUpdate($employeeData){
        $message = "";
        # check email is already exist
        $checkEmail = DB::table('employees')
                        ->where('id', $employeeData['id'])
                        ->where('email','<>', $employeeData['email'])
                        ->first();
        if(empty($checkEmail)){
            try{
                Employee::where('id',$employeeData['id'])
                    ->update([
                        'name'              => $employeeData['name'],
                        'email'             => $employeeData['email'],
                        "date_of_birth"     => $employeeData['dateofbirth'],
                        "phone_no"          => $employeeData['phno'],
                        "nrc_no"            => $employeeData['nrcno'],
                        "address"           => $employeeData['address'],
                        "gender"            => $employeeData['gender'],
                        "maritual_status"   => $employeeData['maritualstatus'],
                        'updated_at'        => Carbon::now()
                    ]);

                $message = "Update successfully";
                return $message;	
            }catch (Throwable $e) {
                Log::channel('debuglog')->debug($e->getMessage(). 'Fail to update data in emplyee table!');
                $message = "Fail to update!";
                return $message;	
            } 
        } else {
            $message = "Email is already exist!";
            return $message;
        }
    }

    public function EmployeeDelete($id){
        $message = "";
        # check email is already exist
        $checkEmail = DB::table('employees')
                        ->where('id', $id)
                        ->first();
        if(!empty($checkEmail)){
            try{
                Employee::where('id',$id)->delete();
                $message = "Delete successfully";
                return $message;	
            }catch (Throwable $e) {
                Log::channel('debuglog')->debug($e->getMessage(). 'Fail to update data in emplyee table!');
                $message = "Fail to update!";
                return $message;	
            } 
        } else {
            $message = "This data is already delete!";
            return $message;
        }
    }
}