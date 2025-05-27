<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\RequestService;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    protected $requestService;

    public function __construct(RequestService $requestService){
        $this->requestService = $requestService;
    }

    public function index(){
        $requests = $this->requestService->getAll();
        return view('pages.requests.index',compact('requests'));
    }

    public function show($id){
        $request = $this->requestService->getRequestDetails($id);
        return view('pages.requests.edit',compact('request'));
    }
}
