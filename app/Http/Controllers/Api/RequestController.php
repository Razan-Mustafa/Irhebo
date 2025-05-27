<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\RequestService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\RequestResource;
use App\Http\Resources\RequestLogResource;
use App\Http\Resources\RequestCommentResource;
use App\Http\Resources\RequestDetailsResource;
use App\Http\Requests\Api\RequestCreateRequest;
use App\Http\Requests\Api\AddRequestCommentRequest;

class RequestController extends Controller
{
    protected $requestService;
    public function __construct(RequestService $requestService)
    {
        $this->requestService = $requestService;
    }
    public function getByUser(Request $request){
        try {
            $perPage = $request->query('per_page');
            $requests = $this->requestService->getByUser($perPage);
            return $this->successResponse(__('success'),[
            'requests'=> RequestResource::collection($requests['data']),
            'meta'=>$requests['meta']]);
        } catch (\Exception $e) {
            return $this->exceptionResponse($e);
        }
    }
    public function getByFreelancer(Request $request)
    {
        try {
            $perPage = $request->input('per_page');
            $requests = $this->requestService->getByFreelancer($perPage);
            return $this->successResponse(
                __('success'),
                [
                    'requests' => RequestResource::collection($requests['data']),
                    'meta' => $requests['meta']
                ]
            );
        } catch (\Exception $e) {
            return $this->exceptionResponse($e);
        }
    }
    public function createRequest(RequestCreateRequest $request)
    {
        try {
            $request = $this->requestService->createRequest($request->validated());
            return $this->successResponse(__('success'), new RequestResource($request));
        } catch (\Exception $e) {
            return $this->exceptionResponse($e);
        }
    }
    public function requestDetails($id){
        try{
            $request = $this->requestService->getRequestDetails($id);
            return $this->successResponse(__('success'), new RequestDetailsResource($request));
        }catch(\Exception $e){
            return $this->exceptionResponse($e);
        }
    }
    public function addComment(AddRequestCommentRequest $request)
    {
        try {
            $data = array_merge($request->validated(), ['user_id' => Auth::id()]);

            $comment = $this->requestService->addComment($data);
            $result = $comment->load('user');

            return $this->successResponse(__('success'), new RequestCommentResource($result));
        } catch (\Exception $e) {
            return $this->exceptionResponse($e);
        }
    }
    public function confirmRequest($id){
        $this->requestService->confirmRequest($id);
        return $this->successResponse(__('success'));
    }
}

