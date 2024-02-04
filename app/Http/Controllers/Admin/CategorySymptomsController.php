<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\CategorySymptom;
use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Validation\Rule;
class CategorySymptomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
         $filtertypes = CategorySymptom::where('category_id',$category->id)->orderBy('id','DESC')->get();
        return view('admin.category_symptoms.index', compact('parentCategories','filtertypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        return view('admin.category_symptoms.add', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Category $category)
    {

          $validator = \Validator::make($request->all(), [
                'name' => 'required',
                'category' => 'required',
          ]);
          if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
          }
          $input = $request->all();
          $filtertype = new CategorySymptom();
          $filtertype->category_id = $input['category'];
          $filtertype->name = $input['name'];
          $filtertype->is_enable = $input['is_enable'];
          if($filtertype->save()){
            return redirect('admin/categories/'.$category->id.'/edit');
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\FilterType  $filterType
     * @return \Illuminate\Http\Response
     */
    public function show(FilterType $filterType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\FilterType  $filterType
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, $additionalDetail)
    {
        if(!$additionalDetail){
            abort(404);
        }
        $additionalDetail = CategorySymptom::find($additionalDetail);
        $filterType = $additionalDetail;
        
        $parentCategories = Category::where('parent_id',NULL)->where('enable','=','1')->get();
        $filterType->category_name = $filterType->category->name;
        return view('admin.category_symptoms.edit', compact('parentCategories','filterType','category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\FilterType  $filterType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Category $category, $additionalDetail)
    {
       
        $validatedData = $this->validate($request, [
                'name' => 'required',
                'category' => 'required',
                'is_enable' => 'required',
           ]);
          $input = $request->all();
          $additionalDetail = CategorySymptom::find($additionalDetail);
          $additionalDetail->name = $input['name'];
         
          $additionalDetail->is_enable = $input['is_enable'];
          if($additionalDetail->save()){
            
          }
          return redirect('admin/categories/'.$category->id.'/edit');
    }


   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\FilterType  $filterType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category,CategorySymptom $filterType)
    {
        if($filterType->delete()){
            return response()->json(['status'=>'success']);
        }else{
            return response()->json(['status'=>'error']);
        }
    }
}
