<?php
namespace App\Http\Controllers;

use App\Model\Page;

use Illuminate\Http\Request;

use App\Helpers\Helper;

use stdClass;

class PagesController extends Controller
{

    public function termscondition(Request $request)
    {

        if($request->has('slug') && $request->has('app_type')){

            Helper::connectByClientKey($request->client_id);

            $pages = Page::where(['slug'=>$request->slug,'app_type' =>$request->app_type])->first();

            if(!$pages){
                $pages=new stdClass();
                $pages->title = 'No Title';
                $pages->body = 'No Description';
            }

            return view('curnik_pages')->with(['pages'=>$pages]);

        }else{

            abort(404);
        }
    }

}
