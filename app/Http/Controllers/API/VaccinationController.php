<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\{Vaccination};
use Validator;
use Auth;

class VaccinationController extends Controller
{
    public function getVaccination(Request $request)
    {
        // $rules = [
        //     'profile_id'  => 'required',
        // ];
        // $validator = Validator::make($request->all(), $rules);
        // if ($validator->fails()) {
        //     return response(array('status' => "error", 'statuscode' => 400, 'message' =>
        //     $validator->getMessageBag()->first()), 400);
        // }
        $user = auth::user();

        $data = Vaccination::where('profile_id',$user->id)->get();
        if($data){
        return response(array('status' => "success", 'statuscode' => 200, 'message' => 'Get Vaccination Successfully', 'data' => $data), 200);
        }
        else {
            $data=array();
            return response(array('status' => "success", 'statuscode' => 200, 'message' => 'No Vaccination Found', 'data' => $data), 200);
        }
    }

    public function createVaccination(Request $request)
    {
        $user= auth::user();
        $rules = [
            'name'                  => 'required',
            'date_adminstrated'     => 'required',
            'pet_weight'            => 'required',
            'next_vaccination_date' => 'required',
            'veternation'           => 'required',
            'veternation_lic_number'=> 'required',
            'lot_number'            => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response(array('status' => "error", 'statuscode' => 400, 'message' =>
            $validator->getMessageBag()->first()), 400);
        }

        $data =  new Vaccination();
        $data->name                      = $request->name;
        $data->date_adminstrated         = $request->date_adminstrated;
        $data->pet_weight                = $request->pet_weight;
        $data->next_vaccination_date     = $request->next_vaccination_date;
        $data->veternation               = $request->veternation;
        $data->lot_number                = $request->lot_number;
        $data->veternation_license_number = $request->veternation_lic_number;
        $data->profile_id                = $user->id;
        $data->save();

        return response(array(
            'status' => "success", 'statuscode' => 200, 'message' => 'Added Vaccination Successfully',
            'data' => $data
        ), 200);
    }

    public function editVaccination(Request $request)
    {
        $data = Vaccination::find($request->id);
        return response(array(
            'status' => "success", 'statuscode' => 200, 'message' => 'edit Vaccination Successfully',
            'data' => $data
        ), 200);
    }

    public function updateVaccination(Request $request)
    {
        $rules = [
            'name'                  => 'required',
            'date_adminstrated'     => 'required',
            'pet_weight'            => 'required',
            'next_vaccination_date' => 'required',
            'veternation'           => 'required',
            'veternation_lic_number'=> 'required',
            'lot_number'            => 'required',
            'profile_id'            => 'required',
            'id'                    => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response(array('status' => "error", 'statuscode' => 400, 'message' =>
            $validator->getMessageBag()->first()), 400);
        }
        $data = Vaccination::where('id', $request->id)->first();
        if (empty($data)) {
            $data = Vaccination::create([
                'name'                      => $request->name,
                'date_adminstrated'         => $request->date_adminstrated,
                'pet_weight'                => $request->pet_weight,
                'next_vaccination_date'     => $request->next_vaccination_date,
                'veternation'               => $request->veternation,
                'veternation_license_number'=> $request->veternation_lic_number,
                'lot_number'                => $request->lot_number,
                'profile_id'                => $request->profile_id,
            ]);
        } else {
            $data->name                      = $request->name;
            $data->date_adminstrated         = $request->date_adminstrated;
            $data->pet_weight                = $request->pet_weight;
            $data->next_vaccination_date     = $request->next_vaccination_date;
            $data->veternation               = $request->veternation;
            $data->veternation_license_number = $request->veternation_lic_number;
            $data->lot_number                = $request->lot_number;
            $data->profile_id                = $request->profile_id;
            $data->save();
        }
        return response(array(
            'status' => "success", 'statuscode' => 200, 'message' => 'Updated Vaccination Successfully',
            'data' => $data
        ), 200);
    }

    public function deleteVaccination(Request $request)
    {
        $data = Vaccination::find($request->id)->Delete();
        return response(
            array('status' => "success", 'statuscode' => 200, 'message' => 'Deleted Vaccination Successfully'),
            200
        );
    }
}
