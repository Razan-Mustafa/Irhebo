<?php

namespace App\Http\Controllers\Freelancer;

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
    // public function index()
    // {
    //     $finances = $this->financeService->getForFreelancer();
    //     return view('pages-freelancer.finances.index', compact('finances'));
    // }

    public function index(Request $request)
    {
        $statusFilter = $request->query('payment_status'); // ممكن تكون 'paid' أو 'unpaid' أو null

        $financesQuery = $this->financeService->getForFreelancer(); // تعديل هنا عشان يرجع Query Builder بدل Collection

        if ($statusFilter === 'paid') {
            $financesQuery->where('payment_status', \App\Enums\PaymentStatusEnum::PAID->value);
        } elseif ($statusFilter === 'unpaid') {
            $financesQuery->where('payment_status', '!=', \App\Enums\PaymentStatusEnum::PAID->value);
        }

        $finances = $financesQuery->get();

        return view('pages-freelancer.finances.index', compact('finances', 'statusFilter'));
    }

    // public function bulkUpdate(Request $request){
    //    $data = $request->validate([
    //     'finance_ids'=>'required|array',
    //     'finance_ids.*'=>'required|numeric'
    //    ]);
    //    $this->financeService->bulkUpdate($data);
    //    return redirect()->route('finances.index')->with('success', __('finances_updated_successfully'));

    // }
}
