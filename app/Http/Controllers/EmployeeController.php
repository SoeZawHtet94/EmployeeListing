<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\EmployeeInterface;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\EmployeeValidationRequest;
use App\Http\Requests\EmployeeValidationUpdate;
use Illuminate\Http\Response;
class EmployeeController extends Controller
{
    public $employeeRepo;
    public function __construct(EmployeeInterface $EmployeeRepo)
    {
        $this->employeeRepo   = $EmployeeRepo;
    }

    public function register(EmployeeValidationRequest $request)
    {
        $result = $this->employeeRepo->EmployeeRegister($request);
        return $result;
    }

    public function update(EmployeeValidationUpdate $request)
    {
        $result = $this->employeeRepo->EmployeeUpdate($request);
        return $result;
    }

    public function delete($id)
    {
        $result = $this->employeeRepo->EmployeeDelete($id);
        return $result;
    }
}
