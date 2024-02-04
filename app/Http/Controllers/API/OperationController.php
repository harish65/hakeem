<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Operation;
use App\Model\OperationMedia;
use Validator, Auth;
use Illuminate\Validation\Rule;

class OperationController extends Controller
{
	private $operationObj;
    private $operationMediaObj;
    public function __construct(Operation $operation, OperationMedia $operationMedia){
        $this->operationObj=$operation;
        $this->operationMediaObj=$operationMedia;
    }
	/**
     * @SWG\Post(
     *     path="/add-operation",
     *     description="Add Operation",
     * tags={"Operations"},
     *     security={
     *     {"Bearer": {}},
     *   },
     *  @SWG\Parameter(
     *         name="category_id",
     *         in="query",
     *         type="string",
     *         description="category id which is matched with admin panel",
     *         required=true,
     *     ),
     *  @SWG\Parameter(
     *         name="sub_category_id",
     *         in="query",
     *         type="string",
     *         description="sub category id which is matched with admin panel",
     *         required=true,
     *     ),
     *  @SWG\Parameter(
     *         name="title",
     *         in="query",
     *         type="string",
     *         description="tittle of operation",
     *         required=true,
     *     ),
          *  @SWG\Parameter(
     *         name="description",
     *         in="query",
     *         type="string",
     *         description="description of operation",
     *         required=true,
     *     ),
     *  @SWG\Parameter(
     *         name="price",
     *         in="query",
     *         type="string",
     *         description="price of operation",
     *         required=true,
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
     */
    public function addOperation(Request $request)
    {

    	$rules = [
    	 	'category_id' => 'required',
    	 	'sub_category_id'=>'required',
    	 	'title'=>'required',
    	 	'description'=>'required',
    	 	'price' => 'required'
    	];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return response(array('status' => "error", 'statuscode' => 400, 'message' =>
                $validator->getMessageBag()->first()), 400);
        }
        try{

        	$data = $request->all();
        	$data['user_id'] = Auth::user()->id;
        	$create = $this->operationObj->addOperation($data);
            $entityBody = json_decode(file_get_contents('php://input'));
            $baseUrl = 'https://consultants3assets.sfo2.digitaloceanspaces.com/';
        	if(isset($entityBody->media) && count($entityBody->media) > 0)
        	{
                $operationId = $create->id;
        		foreach($entityBody->media as $media)
        		{
        			$addMedia = $this->operationMediaObj->addOperationMedia([
	        			'operation_id' => $operationId,
	        			'media_type' => $media->media_type,
	        			'media' => $media->media,
	        			'thumbnail' => $media->thumbnail??null
	        		]);
        		}
        	}

            $operation = Operation::where(['id'=>$create->id])->with('medias')->first();
            if($operation){
                    if($operation->medias){
                        foreach($operation->medias as $_media){
                            if($_media->media_type == 'VIDEO' || $_media->media_type == 'Video'){
                                $_media->media = $baseUrl.'video/'.$_media->media;
                                if($_media->thumbnail){
                                    $_media->thumbnail = $baseUrl.'thumbs/'.$_media->thumbnail;
                                }
                            }elseif($_media->media_type == 'IMAGE' || $_media->media_type == 'Image'){
                                $_media->media = $baseUrl.'uploads/'.$_media->media;
                                if($_media->thumbnail){
                                    $_media->thumbnail = $baseUrl.'thumbs/'.$_media->thumbnail;
                                }
                            }else{
                                $_media->media = $baseUrl.'video/'.$_media->media;
                                if($_media->thumbnail){
                                    $_media->thumbnail = $baseUrl.'thumbs/'.$_media->thumbnail;
                                }
                            }
                    }
                }
            }

        	return response(array('status' => "success", 'statuscode' => 200,'msg'=>'Operation detail added successfully','data'=>$operation), 200);
        }catch(\Exception $e){
        	response(array('status' => "error", 'statuscode' => 400,'msg' => 'Something Went wrong, please try again later.'), 400);
        }
    }
	/**
     * @SWG\Post(
     *     path="/edit-operation",
     *     description="Edit Operation",
     * tags={"Operations"},
     *     security={
     *     {"Bearer": {}},
     *   },
     *  @SWG\Parameter(
     *         name="operation_id",
     *         in="query",
     *         type="string",
     *         description="operation id which is matched with admin panel",
     *         required=true,
     *     ),
     *  @SWG\Parameter(
     *         name="category_id",
     *         in="query",
     *         type="string",
     *         description="category id which is matched with admin panel",
     *         required=true,
     *     ),
     *  @SWG\Parameter(
     *         name="sub_category_id",
     *         in="query",
     *         type="string",
     *         description="sub category id which is matched with admin panel",
     *         required=true,
     *     ),
     *  @SWG\Parameter(
     *         name="title",
     *         in="query",
     *         type="string",
     *         description="tittle of operation",
     *         required=true,
     *     ),
          *  @SWG\Parameter(
     *         name="description",
     *         in="query",
     *         type="string",
     *         description="description of operation",
     *         required=true,
     *     ),
     *  @SWG\Parameter(
     *         name="price",
     *         in="query",
     *         type="string",
     *         description="price of operation",
     *         required=true,
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
     */
    public function editOperation(Request $request)
    {
    	$rules = [
    		'operation_id' => 'required',
    	 	'category_id' => 'required',
    	 	'sub_category_id'=>'required',
    	 	'title'=>'required',
    	 	'description'=>'required',
    	 	'price' => 'required'
    	];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return response(array('status' => "error", 'statuscode' => 400, 'message' =>
                $validator->getMessageBag()->first()), 400);
        }
        try{
        	$data = $request->all();
        	$update = $this->operationObj->updateOperation($data);
        	$delete_media = $this->operationMediaObj->deleteOperationMedia($data['operation_id']);
            $entityBody = json_decode(file_get_contents('php://input'));

        	if(isset($entityBody->media) && count($entityBody->media) > 0)
        	{
                $operationId = $create->id;
        		foreach($$entityBody->media as $media)
        		{
        			$addMedia = $this->operationMediaObj->addOperationMedia([
	        			'operation_id' => $operationId,
	        			'media_type' => $media->media_type,
	        			'media' => $media->media,
	        			'thumbnail' => $media->thumbnail??null
	        		]);
        		}
        	}
        	return response(array('status' => "success", 'statuscode' => 200,'msg'=>'Operation detail added successfully'), 200);
        }catch(\Exception $e){
        	response(array('status' => "error", 'statuscode' => 400,'msg' => 'Something Went wrong, please try again later.'), 400);
        }
    }
    /**
     * @SWG\Post(
     *     path="/delete-operation",
     *     description="Delete Operation",
     * tags={"Operations"},
     *     security={
     *     {"Bearer": {}},
     *   },
     *  @SWG\Parameter(
     *         name="operation_id",
     *         in="query",
     *         type="string",
     *         description="operation id which is matched with admin panel",
     *         required=true,
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
     */
    public function deleteOperation(Request $request)
    {
    	try{
            $rules = [
                'operation_id' => 'required',
            ];
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                return response(array('status' => "error", 'statuscode' => 400, 'message' =>
                    $validator->getMessageBag()->first()), 400);
            }

        	$delete_media = $this->operationMediaObj->deleteOperationMedia($request->operation_id);
        	$delete = $this->operationObj->deleteOperation($request->operation_id);
        	return response(array('status' => "success", 'statuscode' => 200,'msg'=>'Operation detail deleted successfully'), 200);
        }catch(\Exception $e){
        	response(array('status' => "error", 'statuscode' => 400,'msg' => 'Something Went wrong, please try again later.'), 400);
        }
    }

    /**
     * @SWG\Post(
     *     path="/change-status",
     *     description="Change Operation Status",
     * tags={"Operations"},
     *     security={
     *     {"Bearer": {}},
     *   },
     *  @SWG\Parameter(
     *         name="operation_id",
     *         in="query",
     *         type="string",
     *         description="operation id which is matched with admin panel",
     *         required=true,
     *     ),
     * @SWG\Parameter(
     *         name="status",
     *         in="query",
     *         type="integer",
     *         description="1 => Active, 0 => Inactive",
     *         required=true,
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
     */
    public function changeStatusOperation(Request $request)
    {
    	try{
            $rules = [
                'operation_id' => 'required|exists:operations,id',
                "status" => ['required', Rule::in(['1', '0'])],
            ];
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                return response(array('status' => "error", 'statuscode' => 400, 'message' =>
                    $validator->getMessageBag()->first()), 400);
            }

        	$operation = Operation::where(['id'=>$request->operation_id])->update(['status'=>$request->status]);
        	return response(array('status' => "success", 'statuscode' => 200,'msg'=>'Operation status updated successfully'), 200);
        }catch(\Exception $e){
        	response(array('status' => "error", 'statuscode' => 400,'msg' => 'Something Went wrong, please try again later.'), 400);
        }
    }

    /**
     * @SWG\Get(
     *     path="/get-operations",
     *     description="get Operations",
     *     tags={"Operations"},
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
    public static function getOperations(Request $request) {
        try{
            $user = Auth::user();
            $input = $request->all();
            $baseUrl = 'https://consultants3assets.sfo2.digitaloceanspaces.com/';
            $operations = Operation::where(['user_id'=>$user->id])->with('medias')->latest()->get();
            if($operations){
                foreach($operations as $_operation){
                    if($_operation->medias){
                        foreach($_operation->medias as $_media){
                            if($_media->media_type == 'VIDEO' || $_media->media_type == 'Video'){
                                $_media->media = $baseUrl.'video/'.$_media->media;
                                if($_media->thumbnail){
                                    $_media->thumbnail = $baseUrl.'thumbs/'.$_media->thumbnail;
                                }
                            }elseif($_media->media_type == 'IMAGE' || $_media->media_type == 'Image'){
                                $_media->media = $baseUrl.'uploads/'.$_media->media;
                                if($_media->thumbnail){
                                    $_media->thumbnail = $baseUrl.'thumbs/'.$_media->thumbnail;
                                }
                            }else{
                                $_media->media = $baseUrl.'video/'.$_media->media;
                                if($_media->thumbnail){
                                    $_media->thumbnail = $baseUrl.'thumbs/'.$_media->thumbnail;
                                }
                            }
                        }
                    }
                }
            }
            return response(['status' => "success", 'statuscode' => 200,'message' => __('Operations List '), 'data' =>$operations], 200);

        }catch(Exception $ex){
            return response(['status' => "error", 'statuscode' => 500, 'message' => $ex->getMessage().' '.$ex->getLine()], 500);
        }
    }

    /**
     * @SWG\Post(
     *     path="/get-doctor-operations",
     *     description="Get All Operations",
     * tags={"Operations"},
     *     security={
     *     {"Bearer": {}},
     *   },
     *  @SWG\Parameter(
     *         name="user_id",
     *         in="query",
     *         type="string",
     *         description="Doctor Id",
     *         required=true,
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
     */
    public function getOperationsById(Request $request)
    {
    	try{
            $rules = [
                'user_id' => 'required|exists:users,id',
            ];
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                return response(array('status' => "error", 'statuscode' => 400, 'message' =>
                    $validator->getMessageBag()->first()), 400);
            }

        	$user = Auth::user();
            $input = $request->all();
            $baseUrl = 'https://consultants3assets.sfo2.digitaloceanspaces.com/';
            $operations = Operation::where(['user_id'=>$request->user_id])->where(['status'=>1])->with('medias')->latest()->get();
            if($operations){
                foreach($operations as $_operation){
                    if($_operation->medias){
                        foreach($_operation->medias as $_media){
                            if($_media->media_type == 'VIDEO' || $_media->media_type == 'Video'){
                                $_media->media = $baseUrl.'video/'.$_media->media;
                                if($_media->thumbnail){
                                    $_media->thumbnail = $baseUrl.'thumbs/'.$_media->thumbnail;
                                }
                            }elseif($_media->media_type == 'IMAGE' || $_media->media_type == 'Image'){
                                $_media->media = $baseUrl.'uploads/'.$_media->media;
                                if($_media->thumbnail){
                                    $_media->thumbnail = $baseUrl.'thumbs/'.$_media->thumbnail;
                                }
                            }else{
                                $_media->media = $baseUrl.'video/'.$_media->media;
                                if($_media->thumbnail){
                                    $_media->thumbnail = $baseUrl.'thumbs/'.$_media->thumbnail;
                                }
                            }
                        }
                    }
                }
            }
            return response(['status' => "success", 'statuscode' => 200,'message' => __('Operations List '), 'data' =>$operations], 200);

        }catch(Exception $ex){
            return response(['status' => "error", 'statuscode' => 500, 'message' => $ex->getMessage().' '.$ex->getLine()], 500);
        }
    }
}
