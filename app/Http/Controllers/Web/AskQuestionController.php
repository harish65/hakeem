<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Feed;
use App\Model\Support;
use App\Model\MasterPackage;
use Config, Auth;

class AskQuestionController extends Controller
{
    public function getFreeQuestion($question_id){
        $question = Feed::select('id','title','image','description','user_id','created_at')->where('type','question')->where('id',$question_id)->first();
        if(Config::get("default")){
            return view('vendor.default.support',compact('blog'));
        }else{
            return view('vendor.'.Config::get("client_data")->domain_name.'.question-view',compact('question'));
        }
    }
    public function getFreeQuestionListing(){
        $questions = Feed::select('id','title','image')->where('type','question')->latest()->paginate(12);
        if(Config::get("default")){
            return view('vendor.default.support',compact('blogs'));
        }else{
            return view('vendor.'.Config::get("client_data")->domain_name.'.questions',compact('questions'));
        }
    }
    public function myQuestions()
    {
    	try
    	{
            $user = Auth::user();
            $user_id = null;
            if($user->hasrole('service_provider')){
                $user_id = $user->id;
                $questions = Support::select('*')
                ->whereHas('support', function ($query) use($user) {
                    $query->where('assigned_to',$user->id);
                })
                ->where([
                    'type'=>'ask_question'
                ])
                ->latest()->paginate(10);
            }else{
                $questions = Support::select('*')->where([
                    'type'=>'ask_question',
                    'created_by'=>$user->id
                ])
                ->latest()->paginate(10);
            }
            foreach ($questions as $key => $question) {
                $questions[$key] =  Support::getUserQuestionFormat2($question->id,$user_id);
            }
            $can_ask_question = false;
            $can_ask_question = \App\Model\Support::checkCanCreateQuestion($user->id);

            if(Config::get("default")){
	            return view('vendor.default.support');
	        }else{
	            return view('vendor.'.Config::get("client_data")->domain_name.'.my-questions')->with(['questions'=>$questions,'can_ask_question'=>$can_ask_question]);
	        }
        } catch (Exception $e) {
           return redirect()->back()->with(['status' => "error", 'statuscode' => 500, 'message' => $e->getMessage()]);
        }
    }

    public function getAskAQuestion()
    {
        $packages = MasterPackage::latest()->get();
        if(Config::get("default")){
            return view('vendor.default.support');
        }else{
            if(Config::get("client_data")->domain_name =='telegreen'){
                return view('vendor.tele.ask-question',compact('packages'));
            }else{
                return view('vendor.'.Config::get("client_data")->domain_name.'.ask-question',compact('packages'));
            }

        }
    }
}
