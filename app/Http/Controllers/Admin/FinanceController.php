<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FinanceService;
use App\Services\RequestService;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    protected $financeService;

    public function __construct(FinanceService $financeService)
    {
        $this->financeService = $financeService;
    }
    public function index(){
        $finances = $this->financeService->getAll();
        return view('pages.finances.index',compact('finances'));
    }
    public function bulkUpdate(Request $request){
       $data = $request->validate([
        'finance_ids'=>'required|array',
        'finance_ids.*'=>'required|numeric'
       ]);
       $this->financeService->bulkUpdate($data);
       return redirect()->route('finances.index')->with('success', __('finances_updated_successfully'));

    }
}
