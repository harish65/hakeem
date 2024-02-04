<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
class PagesController extends Controller
{
    /**
     * @SWG\POST(
     *     path="/pages",
     *     description="Support Question Packages",
     * tags={"Support"},
     *  @SWG\Parameter(
     *         name="slug",
     *         in="query",
     *         type="string",
     *         description="slug",
     *         required=false,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Please provide all data"
     *     )
     * )
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function termscondition(Request $request)
    {
        $rules = [
            'slug' => "required",
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){

            return response(array('status' => "error", 'statuscode' => 400, 'message' =>
                $validator->getMessageBag()->first()), 400);
        }

        $pages = Page::where('slug',$request->slug)->get();

        return response(array('status' =>"success",'statuscode' => 200,'data'=>$pages,'message' =>__("Request Successfully")), 200);
    }

}
