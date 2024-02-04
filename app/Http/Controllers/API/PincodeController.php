<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Model\Pincode;
use App\Model\ConsultClass;
use App\Model\Package;
use App\Model\UserPackage;
use App\Model\Transaction;
use App\Model\Payment;
use App\Model\AdditionalDetail;
use App\Model\SpAdditionalDetail;
use App\Notification;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Mail;
use DB;
use DateTime;
use DateTimeZone;
use Redirect;
use Response;
use File;
use Image;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use Config;
use App\Model\EnableService;
use App\Model\CategoryServiceProvider;

class PincodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['getPincodes']);
    }
    

    /**
     * @SWG\Get(
     *     path="/pincodes",
     *     description="Get Pincodes",
     *     tags={"Pincodes"},
     *     security={
     *     {"Bearer": {}},
     *   },
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Please provide all data"
     *     )
     * )
     */

    public function getPincodes(Request $request)
    {
        try {
            if (\Config('client_connected') && \Config::get("client_data")->domain_name=="careworks") {
                $per_page = (isset($request->per_page)?$request->per_page:10);
                $orderBy = 'desc';
                if (config('client_connected')) {
                    $orderBy = 'asc';
                }
                $pincodes = Pincode::query();
                $pincodes = $pincodes->where('status', '=', '1')
                ->orderBy('id', $orderBy)
                ->get();
            
                return response(['status' => "success", 'statuscode' => 200,
                                'message' => __('Pincode Listing'), 'data' =>['pincodes'=>$pincodes]], 200);
            }
        } catch (Exception $ex) {
            return response(['status' => "error", 'statuscode' => 500, 'message' => $ex->getMessage()], 500);
        }
    }
}
