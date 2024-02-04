<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;
use Redirect;
use App\Http\Traits\CategoriesTrait;
use App\Model\Role;
use App\Model\CategoryServiceProvider;
use App\Model\Request as RequestTable;
use Auth;
use Aws\Exception\AwsException;




class ClinicController extends Controller
{
    use CategoriesTrait;
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){
            
            $clinics =  User::where('type','=' , 'clinic')->orderBy('id','DESC')->get();
            return view('admin.clinic.index' , compact('clinics'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $parentCategories = $this->parentCategories();
        return view('admin.clinic.create' , compact('parentCategories'));
    } 

    public function store(Request $request){
        $input = $request->all();
        
        $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
                'category' => 'required',
        ];
        if(isset($input['phone'])){
            $rules['phone'] = 'required|unique:users,phone';
        }else{
            $input['phone'] = null;
        }
        $filename = null;
        
       



        $validator = \Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        if ($request->hasfile('logo')) {
           
            if ($image = $request->file('logo')) {
                
                try{
                $extension = $image->getClientOriginalExtension();
                $filename = str_replace(' ', '', md5(time()) . '_' . $image->getClientOriginalName());
                $thumb = \Image::make($image)->resize(
                    100,
                    100,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->encode($extension);
                $normal = \Image::make($image)->resize(
                    400,
                    400,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->encode($extension);
                $big = \Image::make($image)->encode($extension);
                $_800x800 = \Image::make($image)->resize(
                    800,
                    800,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->encode($extension);
                $_400x400 = \Image::make($image)->resize(
                    400,
                    400,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->encode($extension);

                \Storage::disk('spaces')->put('thumbs/' . $filename, (string)$thumb, 'public');
                \Storage::disk('spaces')->put('uploads/' . $filename, (string)$normal, 'public');

                \Storage::disk('spaces')->put('original/' . $filename, (string)$big, 'public');
                \Storage::disk('spaces')->put('800x800/' . $filename, (string)$_800x800, 'public');
                \Storage::disk('spaces')->put('400x400/' . $filename, (string)$_400x400, 'public');
                \Storage::disk('spaces')->put('original/' . $filename, (string)$big, 'public');
                }catch(AwsException $e)    {                    
                    return  back()->withErrors($e->getMessage())->withInput();
                   
                }
                // $user=Auth::user();
                // $user->profile_image = $filename;
                // $user->save();


            }
        }



        $request["status"] = 'verified';
        $input['password'] = bcrypt($input['password']);       
        $user = User::create($input);
        if($user){
            $user->provider_type = 'email';
            $user->device_type = 'web';
            $user->source = 'web';
            $user->profile_image = $filename;
            $user->commission = $request->commission;
            $user->save();
            $role = Role::where('name','clinic')->first();
            if($role){
                $user->roles()->attach($role);
            }
            if(isset($input['category'])){
                if($user->hasrole('clinic')){
                    $category_service = CategoryServiceProvider::where(['sp_id'=>$user->id])->first();
                    if(!$category_service){
                        $category_service =  new CategoryServiceProvider();
                        $category_service->sp_id = $user->id;
                    }
                    $category_service->category_id = $input['category'];
                    $category_service->save();
                }
            }
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
    
    $user = User::find($id);
    if ($request->hasfile('logo')) {
        $filename = null;
        if ($image = $request->file('logo')) {
            $extension = $image->getClientOriginalExtension();
            $filename = str_replace(' ', '', md5(time()) . '_' . $image->getClientOriginalName());
            $thumb = \Image::make($image)->resize(
                100,
                100,
                function ($constraint) {
                    $constraint->aspectRatio();
                }
            )->encode($extension);
            $normal = \Image::make($image)->resize(
                400,
                400,
                function ($constraint) {
                    $constraint->aspectRatio();
                }
            )->encode($extension);
            $big = \Image::make($image)->encode($extension);
            $_800x800 = \Image::make($image)->resize(
                800,
                800,
                function ($constraint) {
                    $constraint->aspectRatio();
                }
            )->encode($extension);
            $_400x400 = \Image::make($image)->resize(
                400,
                400,
                function ($constraint) {
                    $constraint->aspectRatio();
                }
            )->encode($extension);

            \Storage::disk('spaces')->put('thumbs/' . $filename, (string)$thumb, 'public');
            \Storage::disk('spaces')->put('uploads/' . $filename, (string)$normal, 'public');

            \Storage::disk('spaces')->put('original/' . $filename, (string)$big, 'public');
            \Storage::disk('spaces')->put('800x800/' . $filename, (string)$_800x800, 'public');
            \Storage::disk('spaces')->put('400x400/' . $filename, (string)$_400x400, 'public');
            \Storage::disk('spaces')->put('original/' . $filename, (string)$big, 'public');

            // $user=Auth::user();
            $user->profile_image = $filename;
            // $user->save();


        }
    }
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->commission = $request->commission;
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
                return view('admin.clinic.view' , ['consultants' => $consultants , 'id' => $id]);
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

public function deleteDoctor(Request $request){
        try{
            $remove = DB::table('assigned_doctors_to_clinic')->where('clinic_id' , '=' , $request->clinic_id)->where('doctor_id' , '=' , $request->user_id)->delete(); 
            if($remove){
                return response(['status' => "success", 'statuscode' => 200, 'message' => __('Deeleted')], 200);
            }
        }catch(\Illuminate\Database\QueryException  $e){
            return back()->with("error", $e->getMessage());
        }
}

public function doctorBookings($id){
        $admin = User::find($id);        
        $category = $admin->getCategoryData($admin->id);
        $doctors = [];
        if($category){
            $doctors = \App\Model\CustomInfo::where([
            'ref_table'=>'category',
            'ref_table_id'=>$category->id,
            'info_type'=>'custom_sp'])->get();
        }
    $chats = RequestTable::where('to_user',$id)->orderBy('id','desc')->get();
    return view('admin.chats-doctor')->with(['chats'=>$chats]);
}
public function clinicBookings(){
    $allDoctorsInClinic = Auth::user()->id;  
    $doctorsAll = DB::table('assigned_doctors_to_clinic')->where('clinic_id' , '=' , $allDoctorsInClinic)->get()->toArray();       
    if(count($doctorsAll) > 0 ){
        $araryData = array_column($doctorsAll , 'doctor_id'); 
        $doctors =  User::whereIn('id' , $araryData)->get();
        $chats = RequestTable::whereIn('to_user',$araryData)->orderBy('id','desc')->get();
        return view('admin.chats-doctor')->with(['chats'=>$chats]);
        }
}
    public function addRadius(Request $request){        
        $query = DB::table('locations')->update(['radius' => $request->radius]);
            return json_encode(['success'=> true , 'message' => 'Radius added!']);
    }    
}
