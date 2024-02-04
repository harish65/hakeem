<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\{PetCategory,PetBreed,Profile};
use Validator;
use Auth;
class PetController extends Controller
{
    public function getMyPets(Request $request){
        $response=Profile::where('user_id',Auth::user()->id)->whereNotNull('pet_category_id')
                            ->with('PetCategory','PetBreed')
                            ->select('id','user_id','avatar','name','dob','color','special_marking','pet_category_id','pet_breed_id','gender','weight')
                            ->orderBy('id','DESC')->get();
        return response(array('status' => "success", 'statuscode' => 200, 'data' => $response), 200);
    }

    public function ParticularPet(Request $request){
        $response=Profile::where('id',$request->id)->whereNotNull('pet_category_id')->with('PetCategory','PetBreed')->first();
        return response(array('status' => "success", 'statuscode' => 200, 'data' => $response), 200);
    }

    public function createPetProfile(Request $request){
        $rules = ['name'=>'required','avatar' => 'required', 'pet_category_id' => 'required', 'pet_breed_id' => 'required', 'color' => 'required','special_marking'=>'required','gender'=>'required','dob'=>'required','weight'=>'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response(array('status' => "error", 'statuscode' => 400, 'message' =>
            $validator->getMessageBag()->first()), 400);
        }
        try {
            // echo "<pre/>";
            // print_r($validator->validated());
            // die();

            $data = $validator->validated();
            $data['about'] = '';
            $data['user_id']=Auth::user()->id;
            $insert=Profile::create($data);
            if($insert){
                $data = Profile::latest()->first();
                return response(array('status' => "success", 'statuscode' => 200, 'data' => $data), 200);
            }
        } catch (\Throwable $th) {
            return response(['status' => "error", 'statuscode' => 500, 'message' => $th->getMessage()], 500);
        }
    }

    public function getPetCategory(){
        $data=PetCategory::get();
        return response(array('status' => "success", 'statuscode' => 200, 'data' => $data), 200);
    }
    public function getPetBreed(Request $request){
        $data=PetBreed::where('pet_category_id',$request->id)->get();
        return response(array('status' => "success", 'statuscode' => 200, 'data' => $data), 200);
    }
    public function updatePetProfile(Request $request){
        // dd($request->all());
        $rules = ['id'=>'required','name'=>'sometimes|required','avatar' => 'sometimes|required', 'pet_category_id' => 'sometimes|required', 'pet_breed_id' => 'sometimes|required', 'color' => 'sometimes|required','special_marking'=>'sometimes|required','gender'=>'sometimes|required','dob'=>'sometimes|required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response(array('status' => "error", 'statuscode' => 400, 'message' =>
            $validator->getMessageBag()->first()), 400);
        }
        try {
            // echo "<pre/>";
            // print_r($validator->validated());
            // die();
            $data = $validator->validated();
            // dd($data);
            $update=Profile::where('id',$request->id)->update($data);
            if($update){
                return response(array('status' => "success", 'statuscode' => 200, 'data' => []), 200);
            }
        } catch (\Throwable $th) {
            return response(['status' => "error", 'statuscode' => 500, 'message' => $th->getMessage()], 500);
        }
    }
    public function deletePetProfile(Request $request){
        Profile::where('id',$request->id)->delete();
        return response(array('status' => "success", 'statuscode' => 200, 'data' => []), 200);
    }
}
 