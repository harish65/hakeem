<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator,Hash,Mail,DB;
use DateTime,DateTimeZone;
use Redirect,Response,File,Image;
use App\Helpers\Helper;
use App\Model\Request as RequestTable;
use App\Model\PreScription,App\Model\PreScriptionMedicine,App\Model\Image as ModelImage;
use Socialite,Exception;
use Carbon\Carbon,Config;
use App\Notification;
class DynamicPDFController extends Controller
{
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfview(Request $request)
    {
    	if($request->has('request_id')){
    		Helper::connectByClientKey($request->client_id);
	        $requesttable = RequestTable::where('id',$request->request_id)->with('Profile')->first();
	        $app_detail = \App\Model\AppDetail::orderBy('id','DESC')->first();
	        $pre_scription = null;
	        if($requesttable){
	        	$pre_scription =  PreScription::where('request_id',$requesttable->id)->orderBy("id","DESC")->first();
	        	$requesttable->background_color = null;
	        	if($app_detail){
	        		$requesttable->background_color = $app_detail->background_color;
	        	}
		        $requesttable->medicines = [];
		        $requesttable->pre_scription = $pre_scription;
		        if($requesttable->pre_scription && $requesttable->pre_scription->type=="digital"){
		        	if($requesttable->pre_scription->medicines){
		        		$requesttable->medicines = $requesttable->pre_scription->medicines;
		        		unset($requesttable->pre_scription->medicines);
		        	}
		        }elseif($requesttable->pre_scription && $requesttable->pre_scription->type=="manual"){
		        	$requesttable->images = ModelImage::where(['module_table'=>'pre_scriptions','module_table_id'=>$requesttable->pre_scription->id])->get();
		        }
		        view()->share('requesttable',$requesttable);
		        if($request->has('download')){
		        	// die('hehehe');
		        	// Set extra option
		        	\PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
		        	// pass view file
					if(Config::get('client_connected') && Config::get('client_data')->domain_name !='curenik'){
                        $pdf = \PDF::loadView('pdfview');
						return $pdf->download('pdfview.pdf');
					}else
					{
						$pdf = \PDF::loadView('curenik_pdfview1');
						return $pdf->download('curenik_pdfview1.pdf');
					}
		        }
				if(Config::get('client_connected') && Config::get('client_data')->domain_name !='curenik'){

		        	return view('pdfview');
				}
				elseif(Config::get('client_connected') && Config::get('client_data')->domain_name =='curenik'){
					return view('curenik_pdfview1');
				}
				else
				{
					// $pdf = \PDF::loadView('curenik_pdfview1');
					// return $pdf->download('curenik_pdfview1.pdf');
					return view('curenik_pdfview1');
				}
	        }else{
    			abort(404);
	        }
    	}else{
    		abort(404);
    	}
    }

	public function pdfInvoiceview(Request $request)
    {


    	if($request->has('to_date') && $request->has('from_date') && $request->has('id')){

			try{
				$user = User::find($request->id);
				$customer = false;
				if($user->hasrole('customer')){
					$customer = true;
					$requestInvoice = RequestTable::with(['from_users','to_users','transactions' => function ($query) {
								$query->where('transaction_type', 'withdrawal');
							}])->where('from_user',$user->id)->get();
					foreach($requestInvoice as $requestInvoiceInfo){
						$requestInvoiceInfo->service_name=\App\Model\Service::where('id',$requestInvoiceInfo->service_id)->value('type');
					}
				}else{

					$requestInvoice = RequestTable::with(['from_users','to_users','transactions' => function ($query) {
						$query->where('transaction_type', 'withdrawal');
					}])->where('to_user',$user->id)->get();
					foreach($requestInvoice as $requestInvoiceInfo){
						$requestInvoiceInfo->service_name=\App\Model\Service::where('id',$requestInvoiceInfo->service_id)->value('type');
					}
				}

				view()->share('requesttable',$requestInvoice);
				if(count($requestInvoice) > 0){

					$pdf = \PDF::loadView('invoice');
					return $pdf->download('invoice.pdf');
					return view('invoice');

				}else {

					return view('invoice2');
				}

			}catch (\Exception $e) {
				abort(404);
			}
    	}else{

    		abort(404);
    	}
    }

	public function pdfInvoiceview2(Request $request)
    {


    	if($request->has('request_id') && $request->has('id')){

			// try{
				$user = User::find($request->id);
				$customer = false;
				if($user->hasrole('customer')){
					$customer = true;
					$requestInvoice = RequestTable::with(['from_users','to_users','sr_info','clinic_info','transactions' => function ($query) {
								$query->where('transaction_type', 'withdrawal');
							}])
							->where('id',$request->request_id)
							->where('from_user',$user->id)
							->get();
					foreach($requestInvoice as $requestInvoiceInfo){
						$requestInvoiceInfo->service_name=\App\Model\Service::where('id',$requestInvoiceInfo->service_id)->value('type');
					}
				}else{

					$requestInvoice = RequestTable::with(['from_users','to_users','sr_info','clinic_info','transactions' => function ($query) {
						$query->where('transaction_type', 'withdrawal');
					}])->where('to_user',$user->id)
						->where('id',$request->request_id)->get();
					foreach($requestInvoice as $requestInvoiceInfo){
						$requestInvoiceInfo->service_name=\App\Model\Service::where('id',$requestInvoiceInfo->service_id)->value('type');
					}
				}

				view()->share('requesttable',$requestInvoice);
				if(count($requestInvoice) > 0){

					if($user->hasrole('customer')){
						// return view('invoice_user');
						$pdf = \PDF::loadView('invoice_user');
					}else{
						$charges = \App\Model\EnableService::where('type','admin_percentage')->first();
						view()->share('charges',$charges);
						// return view('invoice_service_provider');
						$pdf = \PDF::loadView('invoice_service_provider');
					}

					return $pdf->download('invoice.pdf');
					return view('invoice_user');

				}else {

					return view('invoice2');
				}

			// }catch (\Exception $e) {
			// 	abort(404);
			// }
    	}else{

    		abort(404);
    	}
    }

	public function physoview(Request $request){

		if($request->has('request_id')){
    		Helper::connectByClientKey($request->client_id);
	        $requesttable = RequestTable::where('id',$request->request_id)->first();
	        $app_detail = \App\Model\AppDetail::orderBy('id','DESC')->first();
	        $pre_scription = null;
	        if($requesttable){

				$pre_scription =  PreScription::where('request_id',$requesttable->id)->orderBy("id","DESC")->first();
	        	$requesttable->background_color = null;
	        	if($app_detail){
	        		$requesttable->background_color = $app_detail->background_color;
	        	}
		        $requesttable->medicines = [];
		        $requesttable->pre_scription = $pre_scription;
		        if($requesttable->pre_scription && $requesttable->pre_scription->type=="physio" || $requesttable->pre_scription && $requesttable->pre_scription->type=="dietion"){
		        	if($requesttable->pre_scription->medicines){
		        		$requesttable->medicines = $requesttable->pre_scription->medicines;
		        		unset($requesttable->pre_scription->medicines);
		        	}
		        }
		        view()->share('requesttable',$requesttable);
		        if($request->has('download')){
		        	// die('hehehe');
		        	// Set extra option
		        	\PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
		        	// pass view file
					if(Config::get('client_connected') && Config::get('client_data')->domain_name !='curenik'){
						$pdf = \PDF::loadView('pdfview');
						return $pdf->download('pdfview.pdf');
					}else
					{
						$pdf = \PDF::loadView('curenik_pdfview1');
						return $pdf->download('curenik_pdfview1.pdf');
					}
		        }
				return view('physo');
			}
		}else
		{
			abort(404);
		}
	}

}
