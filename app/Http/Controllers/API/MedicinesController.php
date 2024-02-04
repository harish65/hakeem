<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\{Medicines};
use Validator;
use Auth;

class MedicinesController extends Controller
{
    public function getMedicine(Request $request)
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

        $data = Medicines::where('profile_id', $user->id);
        $day = '';
        if($request->date){
            $day = date('l', strtotime($request->date));
            $data = $data->where('date_intake',$request->date);
            $data->day = $day;
        }
        $data = $data->get();
        return response(array('status' => "success", 'statuscode' => 200, 'message' => 'Get Medicine Successfully', 'data' => $data), 200);
    }

    public function createMedicine(Request $request)
    {
        $rules = [
            'name'          => 'required',
            'date_intake'   => 'required',
            'time_intake'   => 'required',
            'notes'         => 'required',
            'dose_from'     => 'required',
            'dosage'        => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response(array('status' => "error", 'statuscode' => 400, 'message' =>
            $validator->getMessageBag()->first()), 400);
        }
        $user = auth::user();
        $data               =  new Medicines();
        $data->name         = $request->name;
        $data->date_intake  = $request->date_intake;
        $data->time_intake  = $request->time_intake;
        $data->notes        = $request->notes;
        $data->dose_from    = $request->dose_from;
        $data->dosage       = $request->dosage;
        $data->profile_id   = $user->id;

        $data->save();
        return response(array(
            'status' => "success", 'statuscode' => 200, 'message' => 'Added Medicines Successfully',
            'data' => $data
        ), 200);
    }

    public function editMedicine(Request $request)
    {
        $data = Medicines::find($request->id);
        return response(array(
            'status' => "success", 'statuscode' => 200, 'message' => 'edit Medicines Successfully',
            'data' => $data
        ), 200);
    }

    public function updateMedicine(Request $request)
    {
        $rules = [
            'name'          => 'required',
            'date_intake'   => 'required',
            'time_intake'   => 'required',
            'notes'         => 'required',
            'dose_from'     => 'required',
            'dosage'        => 'required',
            'profile_id'    => 'required',
            'id'            => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response(array('status' => "error", 'statuscode' => 400, 'message' =>
            $validator->getMessageBag()->first()), 400);
        }
        $data = Medicines::where('id', $request->id)->first();
        if (empty($data)) {
                $data               =  new Medicines();
                $data->name         = $request->name;
                $data->date_intake  = $request->date_intake;
                $data->time_intake  = $request->time_intake;
                $data->notes        = $request->notes;
                $data->dose_from    = $request->dose_from;
                $data->dosage       = $request->dosage;
                $data->profile_id   = $request->profile_id;
                $data->save();
        } else {
                $data->name         = $request->name;
                $data->date_intake  = $request->date_intake;
                $data->time_intake  = $request->time_intake;
                $data->notes        = $request->notes;
                $data->dose_from    = $request->dose_from;
                $data->dosage       = $request->dosage;
                $data->profile_id   = $request->profile_id;
                $data->save();
        }
        return response(array(
            'status' => "success", 'statuscode' => 200, 'message' => 'Updated Medicine Successfully',
            'data' => $data
        ), 200);
    }

    public function deleteMedicine(Request $request)
    {
        $data = Medicines::find($request->id)->Delete();
        return response(
            array('status' => "success", 'statuscode' => 200, 'message' => 'Deleted Medicine Successfully'),
            200
        );
    }
}
