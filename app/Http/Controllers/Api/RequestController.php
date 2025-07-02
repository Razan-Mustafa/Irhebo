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

    public function __construct(RequestService $requestService ,ContractGeneratorService $contractGenerator)
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
                '{[client_name]}'       => 'Hussam Amira',
                '{[client_email]}'      => 'hussam.amira95@gmail.com',
                '{[client_phone]}'      => '0792856567',

                '{[freelancer_name]}'   => 'Hussam Freelancer',
                '{[freelancer_email]}'  => 'hussam@gmail.com',
                '{[freelancer_phone]}'  => '0792856568',

                '{[contract]}'   => $createdRequest->order_number,
                '{[invoice]}'    => $createdRequest->invoice_number ?? 'INV-' . $createdRequest->id,
                '{[date]}'              => now()->format('Y-m-d'),

                '{[service_title]}'     => 'Test Service',
                '{[delivery_date]}'     => now()->format('Y-m-d'),

                '{[service_price]}'     => '2000 SAR',
                '{[commission]}'        => '2000 SAR',
                '{[tax]}'               => '2000 SAR',
                '{[total_amount]}'      => '2000 SAR',

                '{[revisions]}'         => '2',

            ];


            // 3. Generate PDF contract
            $fileName = $createdRequest->order_number;

            // dd($fileName , $contractData ,$this->contractGenerator);
            $pdfUrl = $this->contractGenerator->generate($contractData, $fileName);
            
            // 4. Optionally save contract path to DB
            $createdRequest->update([
                'contract_path' => $pdfUrl,
            ]);

            return $this->successResponse(__('success'), new RequestResource($createdRequest));
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
