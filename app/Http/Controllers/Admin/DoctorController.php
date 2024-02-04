<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\CategoriesTrait;
use App\Model\Category;
use App\User;
use App\Model\SpAdditionalDetail;
class DoctorController extends Controller
{
    use CategoriesTrait;

    public function index(){
        // return null
    }



    public function create(Request $request){
        // $categories = $this->parentCategories();
        return view('admin.clinic.add-doctor');
    }
    /**
     * Upload doc view From Clinic Dash board
     *  
     * */    

     public function uploadDocuments($id){ 
        $sp_add_details = SpAdditionalDetail::where('sp_id' , $id)->pluck('additional_detail_id')->toArray();
        $cat_selected = \App\Model\CategoryServiceProvider::where('sp_id', $id)->first(); 
        $selectedCategory = null;
        $show = false;
       
        if(isset($cat_selected->category_id) && $cat_selected->category_id !== ''){
            $selectedCategory = $cat_selected->category_id;
            $show = true;
        } 
        if(count($sp_add_details) ==  0){
            $sp_add_details =  null;
        }
        $categories = $this->parentCategories();
        return view ('admin.clinic.documents' , compact('categories' , 'id' ,'selectedCategory' , 'sp_add_details'));
    }




    public function editUploadDocuments($id){
        $sp_add_details = SpAdditionalDetail::where('sp_id' , $id)->get();
        $categories = $this->parentCategories();
        return view ('admin.clinic.edit-doc-upload' , compact('categories' , 'id' ,'sp_add_details'));
    }
    public function updateUploadDocuments($id , $docID){
        
        $sp_add_details = SpAdditionalDetail::where('sp_id' , $id)->where('id' , $docID)->first();
        
        $cat_selected = \App\Model\CategoryServiceProvider::where('sp_id', $id)->first(); 
        $selectedCategory = null;
        $show = false;
        
        if(isset($cat_selected->category_id) && $cat_selected->category_id !== ''){
            $selectedCategory = $cat_selected->category_id;
            $show = true;
        }  
        // echo "<pre>";print_r($sp_add_details);die;
        $categories = $this->parentCategories();
        return view ('admin.clinic.update-doc' , compact('categories' , 'id' ,'selectedCategory' ,'show' ,'sp_add_details'));
    }

    public function updateDocuments(Request $request){
       
        $doc_info = \App\Model\SpAdditionalDetail::where('id', $request->id)->where('sp_id', $request->sp_id)->first();
        if($doc_info == null)
        {
            return redirect('/clinic/edit_upload_documnets/'.$request->sp_id)->with('status.error', 'Not Found');
        }
        if($doc_info->file_name != null)
        {
            $filename = $doc_info->file_name;
        }
        else
        {
            $filename = null;
        }
 
         if ($request->hasfile('image_uploads'))
       {
           if ($image = $request->file('image_uploads'))
           {
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
           }
       }
       \App\Model\SpAdditionalDetail::where('id', $request->id)->where('sp_id', $request->sp_id)->update([
        'title'         =>  $request->input('title'),
        'description'   =>  $request->input('description'),
        'file_name'     =>  $filename
    ]);
        return  redirect('/clinic/edit_upload_documnets/'.$request->sp_id)->with('status.success', 'File Updated');;
    }

    public function deleteDoc(Request $request)
    {
        
        // check doc is owned by logged in user and then delete
        \App\Model\SpAdditionalDetail::where([
            "id"    =>  $request->id,
            "sp_id" =>  $request->sp_id
        ])->delete();
        // redirect to step with message
        return response(array('status' => "success", 'statuscode' => 200, 'message' =>'Document deleted successfully!'), 200);
        // return redirect('/clinic/edit_upload_documnets/'.$request->sp_id)->with('status.success', 'File Removed');
        
    }
    
    public function deleteServiceProvider(Request $request)
    {
        // echo "<pre>";print_r($request->all());die;
        // check doc is owned by logged in user and then delete
        User::where([
            "id"    =>  $request->user_id    
        ])->delete();
        // redirect to step with message
        return response(array('status' => "success", 'statuscode' => 200, 'message' =>'Dcotor deleted successfully!'), 200);
        // return redirect('/clinic/edit_upload_documnets/'.$request->sp_id)->with('status.success', 'File Removed');
        
    }
    public function getSubCategories($id){
        $subcategories = Category::where('name','!=','Find Local Resources')->where('parent_id',$id)->where('enable','=','1')->get();
        return json_encode($subcategories);
    }
}
