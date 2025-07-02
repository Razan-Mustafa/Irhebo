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
use App\Services\ContractGeneratorService;

class RequestController extends Controller
{
    protected $requestService;
    protected $contractGenerator;

    public function __construct(RequestService $requestService, ContractGeneratorService $contractGenerator)
    {
        $this->requestService = $requestService;
        $this->contractGenerator = $contractGenerator;
    }
    public function getByUser(Request $request)
    {
        try {
            $perPage = $request->query('per_page');
            $requests = $this->requestService->getByUser($perPage);
            return $this->successResponse(__('success'), [
                'requests' => RequestResource::collection($requests['data']),
                'meta' => $requests['meta']
            ]);
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
            $validatedData = $request->validated();

            // 1. Create the request
            $createdRequest = $this->requestService->createRequest($validatedData);
            // 2. Prepare data for contract generation
            $contractData = [
                '{[client_name]}'       => $createdRequest['request']->user->username,
                '{[client_email]}'      => $createdRequest['request']->user->email,
                '{[client_phone]}'      => $createdRequest['request']->user->prefix . $createdRequest['request']->user->phone,

                '{[freelancer_name]}'   => $createdRequest['request']->service->user->username,
                '{[freelancer_email]}'  => $createdRequest['request']->service->user->email,
                '{[freelancer_phone]}'  => $createdRequest['request']->service->user->prefix . $createdRequest['request']->service->user->phone,

                '{[contract]}'   => $createdRequest['request']->order_number,
                '{[invoice]}'    => $createdRequest['request']->invoice_number ?? 'INV-' . $createdRequest['request']->id,
                '{[date]}'              => now()->format('Y-m-d'),

                '{[service_title]}'     => $createdRequest['request']->service->translations()->where('language', 'en')->first()->title,
                '{[delivery_date]}'     => $createdRequest['delivery_date'],

                '{[service_price]}'     =>'$'. $createdRequest['finance']->amount,
                '{[commission]}'        =>'$'. $createdRequest['finance']->commission,
                '{[tax]}'               =>'$'. $createdRequest['finance']->fees,
                '{[total_amount]}'      =>'$'. $createdRequest['finance']->total,

                '{[revisions]}'         => $createdRequest['revision'],

            ];
            // dd(  $contractData);


            // 3. Generate PDF contract
            $fileName = substr($createdRequest['request']->order_number, 1);

            // dd($fileName , $contractData ,$this->contractGenerator);
            $pdfUrl = $this->contractGenerator->generate($contractData, $fileName);

            // 4. Optionally save contract path to DB
            $createdRequest['request']->update([
                'contract_path' => $pdfUrl,
            ]);

            return $this->successResponse(__('success'), new RequestResource($createdRequest['request']));
        } catch (\Exception $e) {
            return $this->exceptionResponse($e);
        }
    }
    public function requestDetails($id)
    {
        try {
            $request = $this->requestService->getRequestDetails($id);
            return $this->successResponse(__('success'), new RequestDetailsResource($request));
        } catch (\Exception $e) {
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
    public function confirmRequest($id)
    {
        $this->requestService->confirmRequest($id);
        return $this->successResponse(__('success'));
    }
}
