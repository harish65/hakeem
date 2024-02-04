<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Package;
use Illuminate\Http\Request;
use App\Http\Traits\CategoriesTrait;
use Auth;
use Config;
class PackageController extends Controller
{

     use CategoriesTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(config('client_connected') && (Config::get("client_data")->domain_name == "curenik"))
      { 
         $packages = Package::orderBy('id','DESC')->
         where(function($query){
                $query->whereHas('category', function($q){
                  return $q->where('enable', 1);
              })->where('package_type','category');
          })
         ->orWhere('package_type','open')
         ->get();
      }else
      {
        $packages = Package::orderBy('id','DESC')->
         where(function($query){
                $query->whereHas('category', function($q){
                  return $q->where('enable', 1);
              })->where('package_type','category');
          })
         ->orWhere('package_type','open')
         ->where('created_by',null)->get();
      }
        return view('admin.package.index',compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->getAllCategories();

        $services=\App\Model\Service::all();

        return view('admin.package.add',compact('categories','services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $msg = [];
        $rules = [
                'title' => 'required',
                'description' => 'required|string',
               // 'price'      => 'required|integer|min:1',
                'image' => 'required',
                'total_requests' => 'required|integer|min:1',
                'package_type' => 'required',
                'package_created_for' => 'required'
          ];
          $input = $request->all(); 
          if($input['price'] == null && $input['price'] == '' )
          {
            
            $input['price'] = 0;
          }
          $category_id = null;
          $filter_id = null;
          if(config('client_connected') && (Config::get("client_data")->domain_name == "curenik"))
          { 
            $rules['date_range']='required';
            $rules['service_id']='required';
            $msg['service_id.required']="The service type field is required.";

            
          }
          if(isset($request->image)){
             $rules['image']='required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=480,min_height=400';
             $msg['image.dimensions'] = "image should be min_width=480,min_height=400";
         }
          $validator = \Validator::make($request->all(),$rules,$msg);
          if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
          }
          $category_id = null;
          $enable = '0';
          if(isset($input['category']) && $input['category']){
            $category = explode('_', $input['category']);
            if(count($category)>1){
                $category_id = $category[3];
                $filter_id = $category[1];
            }else{
              $category_id = $category[0];
            }
          }
          if(isset($input['enable']) && $input['enable']){
            $enable = $input['enable'];
          }

          if(isset($input['date_range']) && $input['date_range']){

            $date_range = explode(' to ', $input['date_range']);
            $valid_from =  date('Y-m-d', strtotime($date_range[0]));
            $valid_to =  date('Y-m-d', strtotime($date_range[1]));
          }
          $package = new Package();
          if($request->hasfile('image')) {
            if ($image = $request->file('image')) {
                $extension = $image->getClientOriginalExtension();
                $filename = str_replace(' ','', md5(time()).'_'.$image->getClientOriginalName());
                $thumb = \Image::make($image)->resize(100, 100,
                  function ($constraint) {
                      $constraint->aspectRatio();
                  })->encode($extension);
                $normal = \Image::make($image)->resize(400, 480,
                  function ($constraint) {
                      $constraint->aspectRatio();
                  })->encode($extension);
                $big = \Image::make($image)->encode($extension);
                $_800x800 = \Image::make($image)->resize(800, 800,
                  function ($constraint) {
                      $constraint->aspectRatio();
                  })->encode($extension);
                $_400x400 = \Image::make($image)->resize(400, 400,
                  function ($constraint) {
                      $constraint->aspectRatio();
                  })->encode($extension);
                \Storage::disk('spaces')->put('thumbs/'.$filename, (string)$thumb, 'public');
                \Storage::disk('spaces')->put('uploads/'.$filename, (string)$normal, 'public');
                \Storage::disk('spaces')->put('original/'.$filename, (string)$big, 'public');
                \Storage::disk('spaces')->put('800x800/'.$filename, (string)$_800x800, 'public');
                \Storage::disk('spaces')->put('400x400/'.$filename, (string)$_400x400, 'public');
                \Storage::disk('spaces')->put('original/'.$filename, (string)$big, 'public');
                $package->image = $filename;
            }
          }
        
         if(isset($input['service_id']) && $input['service_id']){

            $services_id=implode(',',$input['service_id']);

         }
          $package->title = $input['title'];
          $package->category_id = $category_id;
          $package->filter_id = $filter_id;
          $package->description = $input['description'];
          $package->price = $input['price'];
          $package->total_requests = $input['total_requests'];
          $package->package_type = $input['package_type'];
          $package->package_created_for = $input['package_created_for'];
          $package->valid_from=isset($valid_from) ? $valid_from : null ;
          $package->valid_to=isset($valid_to) ? $valid_to : null ;
          $package->service_id=isset($services_id) ? $services_id : null  ;
          if(config('client_connected') && (Config::get("client_data")->domain_name == "curenik"))
          { 
            $package->created_from_user = 'admin';
          }
          $package->enable = $enable;
          $package->save();
          return redirect('admin/package');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        $categories = $this->getAllCategories();
        $start_date =  date('Y-m-d', strtotime($package->valid_from));
        $end_date =  date('Y-m-d', strtotime($package->valid_to));
        $package->date_range = $start_date.' to '.$end_date;
        $services=\App\Model\Service::all();
        $package->services_id=explode(',',$package->service_id);
        
        return view('admin.package.edit',compact('categories','package','services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
         $msg = [];
         $rules = [
                'title' => 'required',
                'description' => 'required|string',
               // 'price'      => 'required|integer|min:1',
                'total_requests' => 'required|integer|min:1',
                'enable' => 'required',
                //'package_created_for' => 'required'
          ];
          $input = $request->all(); 
          if($input['price'] == null && $input['price'] == '' )
          {
            
            $input['price'] = 0;
          }
          if($package->package_type=='category'){
            $rules['category'] = "required";
          }
          if($request->hasfile('image')) {
             $rules['image']='required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=480,min_height=400';
             $msg['image.dimensions'] = "image should be min_width=480,min_height=400";
          }
          if(config('client_connected') && (Config::get("client_data")->domain_name == "curenik"))
          { 
            $rules['date_range']='required';
            $rules['service_id']='required';
            $msg['service_id.required']="The service type field is required.";

            
          }
          $validator = \Validator::make($request->all(),$rules,$msg);
          if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
          }
          $category_id = null;
          $filter_id = null;
          if(isset($input['category']) && $input['category']){
            $category = explode('_', $input['category']);
            if(count($category)>1){
                $category_id = $category[3];
                $filter_id = $category[1];
            }else{
              $category_id = $category[0];
            }
          }
          $enable = $input['enable'];
          if($request->hasfile('image')) {
            if ($image = $request->file('image')) {
                $extension = $image->getClientOriginalExtension();
                $filename = str_replace(' ','', md5(time()).'_'.$image->getClientOriginalName());
                $thumb = \Image::make($image)->resize(100, 100,
                  function ($constraint) {
                      $constraint->aspectRatio();
                  })->encode($extension);
                $normal = \Image::make($image)->resize(400, 400,
                  function ($constraint) {
                      $constraint->aspectRatio();
                  })->encode($extension);
                $big = \Image::make($image)->encode($extension);
                $_800x800 = \Image::make($image)->resize(800, 800,
                  function ($constraint) {
                      $constraint->aspectRatio();
                  })->encode($extension);
                $_400x400 = \Image::make($image)->resize(400, 400,
                  function ($constraint) {
                      $constraint->aspectRatio();
                  })->encode($extension);
                \Storage::disk('spaces')->put('thumbs/'.$filename, (string)$thumb, 'public');
                \Storage::disk('spaces')->put('uploads/'.$filename, (string)$normal, 'public');
                \Storage::disk('spaces')->put('original/'.$filename, (string)$big, 'public');
                \Storage::disk('spaces')->put('800x800/'.$filename, (string)$_800x800, 'public');
                \Storage::disk('spaces')->put('400x400/'.$filename, (string)$_400x400, 'public');
                \Storage::disk('spaces')->put('original/'.$filename, (string)$big, 'public');
                $package->image = $filename;
            }
          }
          if(isset($input['date_range']) && $input['date_range']){

            $date_range = explode(' to ', $input['date_range']);
            $valid_from =  date('Y-m-d', strtotime($date_range[0]));
            $valid_to =  date('Y-m-d', strtotime($date_range[1]));
          }
          if(isset($input['service_id']) && $input['service_id']){

            $services_id=implode(',',$input['service_id']);

         }
          $package->title = $input['title'];
          $package->category_id = $category_id;
          $package->filter_id = $filter_id;
          $package->description = $input['description'];
          $package->price = $input['price'];
          $package->total_requests = $input['total_requests'];
          $package->enable = $enable;
          $package->valid_from=isset($valid_from) ? $valid_from : null ;
          $package->valid_to=isset($valid_to) ? $valid_to : null ;
          $package->service_id=isset($services_id) ? $services_id : null  ;
          if(isset($input['package_created_for'])){
            $package->package_created_for =$input['package_created_for'];
          }
          if(config('client_connected') && (Config::get("client_data")->domain_name == "curenik"))
          { 
            $package->created_from_user = 'admin';
          }
          $package->save();
          return redirect('admin/package');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        //
    }

    public function verifyPackage(Request $request){

        $package=Package::find($request->id);
        $package->enable=($request->enable == "true") ? 0 : 1;
        $package->save();
    }
}
