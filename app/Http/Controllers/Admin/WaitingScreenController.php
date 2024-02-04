<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Model\WaitingScreen;

use App\Http\Traits\CategoriesTrait;

class WaitingScreenController extends Controller
{
    use CategoriesTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,WaitingScreen $waitingscreen)
    {
        $waitingscreen=$waitingscreen->all();

        return view('admin.waitingscreen.index',compact('waitingscreen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->parentCategories();
        return view('admin.waitingscreen.add',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,WaitingScreen $waitingscreen)
    {
        $rule = [
            'category_id' => 'required',
        ];
        $msg = [];
        // if(isset($request->image)){
            $rule['image']='required|image|mimes:jpeg,png,jpg,gif,svg';
            $msg['image.dimensions'] = "image should be min_width=516";
        //}
        //if(isset($request->video)){
            $rule['video']='required|mimes:mp4,mov,ogg,qt |max:20000';
            $msg['video.max'] = "Video should be max=2MB";
        //}
        $validator = \Validator::make($request->all(),$rule,$msg);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        }

        $waitingscreen->category_id = $request->category_id;
        if($request->hasfile('image')) {
            if ($image = $request->file('image')) {
                $extension = $image->getClientOriginalExtension();
                $filename = str_replace(' ','', md5(time()).'_'.$image->getClientOriginalName());
                $thumb = \Image::make($image)->resize(100, 100,
                  function ($constraint) {
                      $constraint->aspectRatio();
                  })->encode($extension);
                $normal = \Image::make($image)->resize(688, 416,
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
                $waitingscreen->image = $filename;
            }
        }
        if($request->hasfile('video')) {
            if ($image = $request->file('video')) {
                $extension = $image->getClientOriginalExtension();
                $filename = str_replace(' ','', md5(time()).'_'.$image->getClientOriginalName());
                $FileEnconded=  \File::get($request->file('video'));
                \Storage::disk('spaces')->put('video/'.$filename, (string)$FileEnconded, 'public');

                $waitingscreen->video = $filename;
            }
        }
        $waitingscreen->save();

        return redirect()->route('waiting.index')->with('success','Screen Create Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\WaitingScreenController  $waitingScreenController
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\WaitingScreenController  $waitingScreenController
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\WaitingScreenController  $waitingScreenController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\WaitingScreenController  $waitingScreenController
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }
}
