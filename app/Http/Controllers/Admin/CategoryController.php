<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Service;
use App\Model\CategoryServiceType;
use Illuminate\Http\Request;
use Config;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parentCategories = Category::where('parent_id',NULL)->orderBy('enable','desc')->orderBy('id','desc')->get();
        return view('admin.categories.index', compact('parentCategories'));
    }

    public function disbaleOrEnableCategory(Request $request){
       $input = $request->all();
       $category = Category::where('id',$input['category_id'])->first();
       if($category){
          if($input['disable']=='true'){
              $category->enable = '0';
          }else{
              $category->enable = '1';
          }
          $category->save();
       }
       return response()->json(['status'=>'success']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.add');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addSubCategory(Category $category)
    {
        return view('admin.categories.add',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $input = $request->all();
        $rule = [
            'name'      => 'required|min:3|max:255|string',
            'parent_id' => 'sometimes|nullable|numeric',
            'color_code' => 'required',
      ];
      $sessionatcentre = false;
      if(Config('client_connected') && Config::get("client_data")->domain_name=="physiotherapist" && isset($input['parent_id']) && $input['parent_id']==2){
        $sessionatcentre = true;
        $rule['email'] = 'required|email|unique:users,email';
      }
      if(Config('client_connected') && Config::get("client_data")->domain_name=="careworks"){
        $rule['time_slot'] = 'required';
      }
      $msg = [];
      if($request->hasfile('category_image')) {
          $rule['category_image']='required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=50,min_height=50';
          $msg['category_image.dimensions'] = "image should be min_width=50,min_height=50";
       }
       if($request->hasfile('image_icon')) {
          $rule['image_icon']='required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=50,min_height=50';
          $msg['image_icon.dimensions'] = "image should be min_width=50,min_height=50";
       }
      $validator = \Validator::make($request->all(),$rule,$msg);
      if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
      }
      $image_name = null;
      $cat = new Category();
      if($request->hasfile('category_image')) {
            if ($image = $request->file('category_image')) {
                $extension = $image->getClientOriginalExtension();
                $filename = str_replace(' ','', md5(time()).'_'.$image->getClientOriginalName());
                $thumb = \Image::make($image)->resize(100, 100,
                  function ($constraint) {
                      $constraint->aspectRatio();
                  })->encode($extension);
                $normal = \Image::make($image)->resize(260, 260,
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
              $cat->image = $filename;
            }
        }
      if(isset($input['parent_id'])){
        $cat->parent_id = $input['parent_id'];
      }
      if(isset($input['name'])){
        $cat->name = $input['name'];
      }
      if(Config('client_connected') && Config::get("client_data")->domain_name=="mataki"){
        if(isset($input['services'])){
            $cat->doctor_service = $input['services'];
        }
     }
      if(Config('client_connected') && Config::get("client_data")->domain_name=="care_connect_live"){
        if(isset($input['percentage'])){
          $cat->percentage = $input['percentage'];
        }
        $cat->enable_percentage = $input['enable_percentage'];
      }
      if($request->hasfile('image_icon')) {
          if ($image = $request->file('image_icon')) {
              $extension = $image->getClientOriginalExtension();
                $filename = str_replace(' ','', md5(time()).'_'.$image->getClientOriginalName());
                $thumb = \Image::make($image)->resize(100, 100,
                  function ($constraint) {
                      $constraint->aspectRatio();
                  })->encode($extension);
               $normal = \Image::make($image)->resize(260, 260,
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
              $cat->image_icon = $filename;
          }
      }
      if(isset($input['color_code'])){
        $cat->color_code = str_replace('#','',$input['color_code']);
      }
      if(isset($input['description'])){
        $cat->description = $input['description'];
      }
      if(isset($input['enable_service_type'])){
        $cat->enable_service_type = $input['enable_service_type'];
      }
      $cat->enable = '1';
      if(isset($input['enable'])){
        $cat->enable = $input['enable'];
      }
      if(isset($input['time_slot'])){
        $cat->time_slot = implode(',',$input['time_slot']);
      }
      $cat->save();
      if(Config('client_connected') && Config::get("client_data")->domain_name=="iedu"){
          $categoryservicetype = CategoryServiceType::createServiceByCategory(1,$cat->id,null,1,100000);
      }
      if($sessionatcentre){
          $service_id = Service::getServiceIdByMainType('clinic_visit');
          $categoryservicetype = CategoryServiceType::createServiceByCategory($service_id,$cat->id,$input['price'],null,null);
          $row = [
            'category_id'=>$cat->id,
            'address'=>$cat->description,
            'name'=>$cat->name,
            'email'=>$input['email'],
            'lat'=>$input['lat'],
            'long'=>$input['long'],
            'image'=>$cat->image_icon,
            'cat_service_type'=>$categoryservicetype->id,
            'service_id'=>$service_id,
          ];
          \App\User::createSessionUser($row);
      }
      if($cat->parent_id){
        return redirect()->route('categories.edit',$cat->parent_id)->withSuccess('You have successfully created a Category!');
      }else{
        return redirect()->route('categories.index')->withSuccess('You have successfully created a Category!');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        // print_r($category);die;
        $category->user = \App\User::getSessionUser($category->id);
        $category->price = CategoryServiceType::getSessionPrice($category->id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
      $input = $request->all();
        $rule = [
            'name'      => 'required|min:3|max:255|string',
            'color_code' => 'required',
      ];
      $sessionatcentre = false;
      if(Config('client_connected') && Config::get("client_data")->domain_name=="physiotherapist" && isset($category->parent_id) && $category->parent_id==2){
        $user = \App\User::getSessionUser($category->id);
        $sessionatcentre = true;
        if($user)
          $rule['email'] = 'email|unique:users,email,' . $user->id;
        else
          $rule['email'] = 'required|email|unique:users,email';
        $rule['price'] = 'required';
      }
      if(Config('client_connected') && Config::get("client_data")->domain_name=="careworks"){
        $rule['time_slot'] = 'required';
      }
      $msg = [];
      if($request->hasfile('image')) {
          $rule['image']='required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=50,min_height=50';
          $msg['image.dimensions'] = "image should be min_width=50,min_height=50";
       }
       if($request->hasfile('image_icon')) {
          $rule['image_icon']='required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=50,min_height=50';
          $msg['image_icon.dimensions'] = "image should be min_width=50,min_height=50";
       }
      $validator = \Validator::make($request->all(),$rule,$msg);
          if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
          }
      if($request->hasfile('image')) {
        if ($image = $request->file('image')) {
            $extension = $image->getClientOriginalExtension();
                $filename = str_replace(' ','', md5(time()).'_'.$image->getClientOriginalName());
                $thumb = \Image::make($image)->resize(100, 100,
                  function ($constraint) {
                      $constraint->aspectRatio();
                  })->encode($extension);
                $normal1 = \Image::make($image)->resize(260, 260,
                  function ($constraint1) {
                      $constraint1->aspectRatio();
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
                \Storage::disk('spaces')->put('uploads/'.$filename, (string)$normal1, 'public');
                \Storage::disk('spaces')->put('original/'.$filename, (string)$big, 'public');
                \Storage::disk('spaces')->put('800x800/'.$filename, (string)$_800x800, 'public');
                \Storage::disk('spaces')->put('400x400/'.$filename, (string)$_400x400, 'public');
                \Storage::disk('spaces')->put('original/'.$filename, (string)$big, 'public');
            $category->image = $filename;
        }
      }
      if($request->hasfile('image_icon')) {
        if ($image = $request->file('image_icon')) {
            $extension = $image->getClientOriginalExtension();
                $filename = str_replace(' ','', md5(time()).'_'.$image->getClientOriginalName());
                $thumb = \Image::make($image)->resize(100, 100,
                  function ($constraint) {
                      $constraint->aspectRatio();
                  })->encode($extension);
                $normal = \Image::make($image)->resize(260, 260,
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
            $category->image_icon = $filename;
        }
      }


      if($request->hasfile('banner')) {
        if ($image = $request->file('banner')) {
            $extension = $image->getClientOriginalExtension();
                $filename = str_replace(' ','', md5(time()).'_'.$image->getClientOriginalName());
                $thumb = \Image::make($image)->resize(100, 100,
                  function ($constraint) {
                      $constraint->aspectRatio();
                  })->encode($extension);
                $normal = \Image::make($image)->resize(260, 260,
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
            $category->banner = $filename;
        }
      }


      $input = $request->all();
      if(isset($input['name'])){
        $category->name = $input['name'];
      }

      if(isset($input['description_text'])){
        $category->description_text = $input['description_text'];
      }
      if(Config('client_connected') && Config::get("client_data")->domain_name=="care_connect_live"){
        if(isset($input['percentage'])){
          $category->percentage = $input['percentage'];
        }
        $category->enable_percentage = $input['enable_percentage'];
      }
      if($request->hasfile('video')) {
          if ($image = $request->file('video')) {
          $extension = $image->getClientOriginalExtension();
          $filename = str_replace(' ','', md5(time()).'_'.$image->getClientOriginalName());
           $FileEnconded=  \File::get($request->video);
            \Storage::disk('spaces')->put('video/'.$filename, (string)$FileEnconded,'public');
            $category->video = $filename;
        }
      }
      if(isset($input['color_code'])){
        $category->color_code = str_replace('#','',$input['color_code']);
      }
      if(isset($input['description'])){
        $category->description = $input['description'];
      }
      if(isset($input['enable'])){
        $category->enable = $input['enable'];
      }
      if(isset($input['enable_service_type'])){
        $category->enable_service_type = $input['enable_service_type'];
      }

      if(isset($input['top_speciality'])){
        $category->top_speciality = $input['top_speciality'];
      }

      if(isset($input['time_slot'])){
        $category->time_slot = implode(',',$input['time_slot']);
      }

      if(Config('client_connected') && Config::get("client_data")->domain_name=="mataki"){
        if(isset($input['services'])){
            $category->doctor_service = $input['services'];
        }
     }

      $category->save();
      if(Config('client_connected') && Config::get("client_data")->domain_name=="iedu"){
          $categoryservicetype = CategoryServiceType::createServiceByCategory(1,$category->id,null,1,100000);
      }
      if($sessionatcentre){
          $service_id = Service::getServiceIdByMainType('clinic_visit');
          $categoryservicetype = CategoryServiceType::createServiceByCategory($service_id,$category->id,$input['price'],null,null);
          $row = [
            'category_id'=>$category->id,
            'address'=>$category->description,
            'name'=>$category->name,
            'email'=>$input['email'],
            'lat'=>$input['lat'],
            'long'=>$input['long'],
            'image'=>$category->image_icon,
            'cat_service_type'=>$categoryservicetype->id,
            'service_id'=>$service_id,
            'user'=>$user,
            'update'=>true,
          ];
          // dd($row);die;
          \App\User::createSessionUser($row);
      }
      return redirect()->back()->withSuccess('You have successfully updated a Category!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }

    public  function getCategories(Request $request)
    {
        try {
            
            if (\Config('client_connected') && \Config::get("client_data")->domain_name == "iedu") {
                $per_page = (isset($request->per_page) ? $request->per_page : 10);
                $parent_id = (isset($request->parent_id) ? $request->parent_id : NULL);
                $user_type = (isset($request->user_type) ? $request->user_type : NULL);
                $local_resources = (isset($request->local_resources) ? $request->local_resources : '0');
                $orderBy = 'desc';
                if (config('client_connected')) {
                    $orderBy = 'asc';
                }
                $parentCategories = Category::query();
                if (Auth::guard('api')->check() && isset($request->selected_category) && $request->selected_category) {
                    $sub_categorie_ids = \App\Model\CategoryServiceProvider::where('sp_id', Auth::guard('api')->user()->id)->pluck('category_id')->toArray();
                    $categorie_ids = Category::whereIn('id', $sub_categorie_ids)->pluck('parent_id')->toArray();
                    $parentCategories = $parentCategories->whereIn('id', $categorie_ids);
                    // print_r(Auth::guard('api')->user()->id);die;
                }

                $parentCategories = $parentCategories->where('parent_id', $parent_id)
                    ->where('enable', '=', '1')
                    // ->with('subcategory')
                    ->orderBy('id', $orderBy)
                    ->get();
                $after = null;
                foreach ($parentCategories as $key => $category) {
                    $category->packages = false;
                    if (Package::where(['category_id' => $category->id, 'enable' => '1'])->count() > 0) {
                        $category->packages = true;
                    }
                    $category->is_filters = false;
                    if ($category->filters->count() > 0) {
                        $category->is_filters = true;
                    }
                    $category->is_additionals = false;
                    if ($category->additionals->count() > 0) {
                        $category->is_additionals = true;
                    }
                    $subcategory = Category::where('parent_id', $category->id)->where('enable', '=', '1')->count();
                    if (Auth::guard('api')->check() && isset($request->selected_category) && $request->selected_category) {
                        $sub_categorie_ids = \App\Model\CategoryServiceProvider::where('sp_id', Auth::guard('api')->user()->id)->pluck('category_id')->toArray();
                        $category->subcategory = Category::whereIn('id', $sub_categorie_ids)->where('parent_id', $category->id)->where('enable', '=', '1')->get();
                        // print_r($category->subcategory);die;
                    }
                    $category->subcategory;
                    if ($category->parent_id == null) {
                        $banner = \App\Model\Banner::where(['category_id' => $category->id, 'banner_type' => 'category'])->where('enable', '=', '1')->first();
                        if ($banner)
                            $category->banner = $banner->image_web;
                    }
                    $category->doctor_detail = null;
                    if (\Config('client_connected') && \Config::get("client_data")->domain_name == "physiotherapist"  && $category->parent_id == 2) {
                        $category->doctor_detail = \App\User::getSessionDoctorDetail($category->id);
                    }
                    if ($subcategory > 0) {
                        $category->is_subcategory = true;
                    } else {
                        $category->is_subcategory = false;
                    }
                    unset($category->filters);
                    // unset($category->subcategory);
                    unset($category->additionals);
                }

                return response([
                    'status' => "success", 'statuscode' => 200,
                    'message' => __('Category Listing'), 'data' => ['classes_category' => $parentCategories]
                ], 200);
            } elseif (\Config('client_connected') && \Config::get("client_data")->domain_name == "curenik") {
                $per_page = (isset($request->per_page) ? $request->per_page : 10);
                $parent_id = (isset($request->parent_id) ? $request->parent_id : NULL);
                $user_type = (isset($request->user_type) ? $request->user_type : NULL);
                $local_resources = (isset($request->local_resources) ? $request->local_resources : '0');
                $top_speciality = (isset($request->top_speciality) ? $request->top_speciality : NULL);
                $orderBy = 'desc';
                if (config('client_connected')) {
                    $orderBy = 'asc';
                }
                // print_r($local_resources);die;
                // $packages = \App\Helpers\Helper::checkFeatureExist([
                //                     'client_id'=>\Config::get('client_id'),
                //                     'feature_name'=>'Packages']);
                $Find_Local_Resource = Category::where('name', '=', 'Find Local Resources')->first();
                if ($Find_Local_Resource && $local_resources == '0') {
                    $parentCategories = Category::where('parent_id', $parent_id)
                        ->where('enable', '=', '1')
                        ->where('id', '!=', $Find_Local_Resource->id)
                        ->with('subcategory');
                    if (isset($top_speciality) && $top_speciality == 1) {
                        $parentCategories->where('top_speciality', 1);
                    }
                    $parentCategories->orderBy('id', $orderBy);
                    $parentCategories = $parentCategories->get();
                } else {
                    $parentCategories = Category::where('parent_id', $parent_id)
                        ->where('enable', '=', '1')
                        ->with('subcategory');
                    if (isset($top_speciality) && $top_speciality == 1) {
                        $parentCategories->where('top_speciality', 1);
                    }
                    $parentCategories->orderBy('id', $orderBy);
                    $parentCategories = $parentCategories->get();
                }
                $after = null;
                foreach ($parentCategories as $key => $category) {
                    $category->packages = false;
                    if (Package::where(['category_id' => $category->id, 'enable' => '1'])->count() > 0) {
                        $category->packages = true;
                    }
                    $category->is_filters = false;
                    if ($category->filters->count() > 0) {
                        $category->is_filters = true;
                    }
                    // $category->is_additionals = false;
                    // if($category->additionals->count() > 0){
                    $category->is_additionals = true;
                    //}
                    $subcategory = Category::where('parent_id', $category->id)->where('enable', '=', '1')->count();
                    if ($category->parent_id == null) {
                        $banner = \App\Model\Banner::where(['category_id' => $category->id, 'banner_type' => 'category'])->where('enable', '=', '1')->first();
                        if ($banner)
                            $category->banner = $banner->image_web;
                    }
                    $category->doctor_detail = null;
                    if (\Config('client_connected') && \Config::get("client_data")->domain_name == "physiotherapist"  && $category->parent_id == 2) {
                        $category->doctor_detail = \App\User::getSessionDoctorDetail($category->id);
                    }
                    if ($subcategory > 0) {
                        $category->is_subcategory = true;
                    } else {
                        $category->is_subcategory = false;
                    }
                    unset($category->filters);
                    // unset($category->subcategory);
                    unset($category->additionals);
                }

                return response([
                    'status' => "success", 'statuscode' => 200,
                    'message' => __('Category Listing'), 'data' => ['classes_category' => $parentCategories]
                ], 200);
            } else {

                $per_page = (isset($request->per_page) ? $request->per_page : 10);
                $parent_id = (isset($request->parent_id) ? $request->parent_id : NULL);
                $user_type = (isset($request->user_type) ? $request->user_type : NULL);
                $local_resources = (isset($request->local_resources) ? $request->local_resources : '0');
                $top_speciality = (isset($request->top_speciality) ? $request->top_speciality : NULL);
                $orderBy = 'desc';
                if (config('client_connected')) {
                    $orderBy = 'asc';
                }

                $Find_Local_Resource = Category::where('name', '=', 'Find Local Resources')->first();
                if ($Find_Local_Resource && $local_resources == '0') {
                    $parentCategories = Category::where('parent_id', $parent_id)
                        ->where('enable', '=', '1')
                        ->where('id', '!=', $Find_Local_Resource->id)
                        ->with('subcategory');
                    if (isset($top_speciality) && $top_speciality == 1) {
                        $parentCategories->where('top_speciality', 1);
                    }
                    $parentCategories->orderBy('id', $orderBy);
                    $parentCategories = $parentCategories->cursorPaginate($per_page);
                } else {

                    $parentCategories = Category::where('parent_id', $parent_id)
                        ->where('enable', '=', '1')
                        ->with('subcategory');
                    if (isset($top_speciality) && $top_speciality == 1) {
                        $parentCategories->where('top_speciality', 1);
                    }
                    $parentCategories->orderBy('id', $orderBy);
                    $parentCategories = $parentCategories->cursorPaginate($per_page);
                }


                $after = null;
                foreach ($parentCategories as $key => $category) {
                    $category->packages = false;
                    if (Package::where(['category_id' => $category->id, 'enable' => '1'])->count() > 0) {
                        $category->packages = true;
                    }
                    $category->is_filters = false;
                    if ($category->filters->count() > 0) {
                        $category->is_filters = true;
                    }

                    $category->is_additionals = false;
                    if ($category->additionals->count() > 0) {
                        $category->is_additionals = true;
                    }
                    $subcategory = Category::where('parent_id', $category->id)->where('enable', '=', '1')->count();
                    if ($category->parent_id == null) {
                        $banner = \App\Model\Banner::where(['category_id' => $category->id, 'banner_type' => 'category'])->where('enable', '=', '1')->first();
                        if ($banner)
                            $category->banner = $banner->image_web;
                    }
                    $category->doctor_detail = null;
                    if (\Config('client_connected') && \Config::get("client_data")->domain_name == "physiotherapist"  && $category->parent_id == 2) {
                        $category->doctor_detail = \App\User::getSessionDoctorDetail($category->id);
                    }
                    if ($subcategory > 0) {
                        $category->is_subcategory = true;
                    } else {
                        $category->is_subcategory = false;
                    }
                    unset($category->filters);
                    // unset($category->subcategory);
                    unset($category->additionals);
                }
                if ($parentCategories->meta['next']) {
                    $after = $parentCategories->meta['next']->target;
                }
                $before = null;
                if ($parentCategories->meta['previous']) {
                    $before = $parentCategories->meta['previous']->target;
                }
                $per_page = $parentCategories->perPage();
                return response([
                    'status' => "success", 'statuscode' => 200,
                    'message' => __('Category Listing'), 'data' => ['classes_category' => $parentCategories->items(), 'after' => $after, 'before' => $before, 'per_page' => $per_page]
                ], 200);
            }
        } catch (Exception $ex) {
            return response(['status' => "error", 'statuscode' => 500, 'message' => $ex->getMessage()], 500);
        }
    }

}
