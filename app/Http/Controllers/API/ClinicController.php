<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;
use Redirect;
use Config;

class ClinicController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getAllClinics(){
            try{
                $clinics =  User::select('users.profile_image as image' , 'users.*')->where('type','=' , 'clinic')->orderBy('id','DESC')->get()->toArray();
                if(count($clinics) > 0){
                    return response([
                        'status' => "success", 'statuscode' => 200,
                        'message' => __('Clinic Listing'), 'data' => ['classes_category' => $clinics]
                    ], 200);  
                }else{
                    return response([
                        'status' => "success", 'statuscode' => 200,
                        'message' => __('Clinic Listing'), 'data' => ['classes_category' => 'No clinic added yet!']
                    ], 200); 
                    // return json_encode(['success' => true , 'clinics' => 'No clinic added yet!']);    
                }
            }catch(\Illuminate\Database\QueryException $e){
                 return json_encode(['success' => false , 'message' => $e->getMessage]);
            }
    }


    public function getClinicDoctors(Request $request){
        try{
            $clinics =  DB::table('assigned_doctors_to_clinic')->where('clinic_id','=' , $request->id)->orderBy('id','DESC')->get()->toArray();
            $araryData = array_column($clinics , 'doctor_id'); 
            $doctors =  User::whereIn('id' , $araryData)->get();
            if(count($clinics) > 0){
                return response([
                    'status' => "success", 'statuscode' => 200,
                    'message' => __('Doctor Listing'), 'data' => ['doctors' => $doctors]
                ], 200);  
            }else{
                return response([
                    'status' => "success", 'statuscode' => 200,
                    'message' => __('Doctor Listing'), 'data' => ['doctors' => 'No doctor added yet!']
                ], 200); 
                // return json_encode(['success' => true , 'clinics' => 'No clinic added yet!']);    
            }
        }catch(\Illuminate\Database\QueryException $e){
             return json_encode(['success' => false , 'message' => $e->getMessage]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
      return view('admin.clinic.create');
    } 

    public function store(Request $request){
        $input = $request->all();
        $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8'
        ];
        if(isset($input['phone'])){
            $rules['phone'] = 'required|unique:users,phone';
        }else{
            $input['phone'] = null;
        }
        $validator = \Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $request["status"] = 'verified';
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        if($user){
            return redirect()->route('clinic');
        }

    }

/* Show the form for editing the specified resource.
    *
    * @param  \App\User  $user
    * @return \Illuminate\Http\Response
*/
   public function edit($id)
   {
        $clinic = User::find($id);
        return view('admin.clinic.edit')->with(['clinic'=>$clinic]);
   }


   public function update(Request $request , $id){
    $input = $request->all();
    $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
    ];
    if(isset($input['phone'])){
        $rules['phone'] = 'required|unique:users,phone,'.$id;
    }else{
        $input['phone'] = null;
    }
    $validator = \Validator::make($request->all(),$rules);
    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }
    
    $user = User::find($request->id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->save();

    if($user){
        return redirect()->route('clinic');
    }
}

public function delete($id){
    $clinic = User::where('id',$id)->delete();
    return response()->json(['status'=>'success']);
}

public function doctorsAll($id){
    $doctors = DB::table('assigned_doctors_to_clinic')->select('doctor_id')->get()->toArray();
    $araryData = array_column($doctors , 'doctor_id');
    $consultants = User::with('userInsurances.insurance')->whereHas('roles', function ($query) {
        $query->where('name','service_provider');
     })->where('permission',null)->whereNotIn('id' , $araryData)->orderBy('id','DESC')->get();    
    return view('admin.clinic.doctors')->with(['consultants' => $consultants , 'clicnicId' => $id ]);
}


public function addDoctorsToClinic(Request $request , $id){
        $input = $request->all();
        if(count($input) > 0){
            // $values = array();
            try{
                foreach($input['doctor_ids'] as $doctor){
                    $insert = DB::table('assigned_doctors_to_clinic')->insert(['clinic_id' => $id , 'doctor_id' => $doctor]);
                } 
                return json_encode(['success'=> true , 'message' => 'Success!']);
            }catch(\Illuminate\Database\QueryException  $e){
                return json_encode(['success'=> false , 'message' => $e->getMessage()]);
            }
        }
}

public function getDoctorsFromClinic($id){
    if($id){
        try{
            $allDoctorsInClinic = DB::table('assigned_doctors_to_clinic')->where('clinic_id' , '=' , $id)->get()->toArray(); 
            if(count($allDoctorsInClinic) > 0 ){
                $araryData = array_column($allDoctorsInClinic , 'doctor_id'); 
                $consultants =  User::whereIn('id' , $araryData)->get();
                return view('admin.clinic.view' , ['consultants' => $consultants]);
            }else{
                return back()->with("error", "No doctor added yet in this clinic!");
            }
        }catch(\Illuminate\Database\QueryException  $e){
            return back()->with("error", $e->getMessage());
        }
    }else{
        return back()->with("error", 'Clinic can not be null!');
    }

}

}
