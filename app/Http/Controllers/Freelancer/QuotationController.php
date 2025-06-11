<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use App\Models\Quotation_Comments;
use App\Services\QuotationService;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    protected $quotationService;

    public function __construct(QuotationService $quotationService)
    {
        $this->quotationService = $quotationService;
    }

    public function index()
    {
        $quotations = $this->quotationService->getQuotationsForFreelancerWithComment();
        // dd($quotations);
        return view('pages-freelancer.quotations.index', compact('quotations'));
    }
    public function show($id)
    {
        $quotation = $this->quotationService->getQuotationDetails($id);
        return view('pages-freelancer.quotations.show', compact('quotation'));
    }

    public function createComment($quotationId)
    {
        $quotation = Quotation::findOrFail($quotationId);
        return view('pages-freelancer.quotations.create', compact('quotation'));
    }

    public function storeComment(Request $request, $quotationId)
    {
        $request->validate([
            'comment' => 'required|string'
        ]);

        Quotation_Comments::create([
            'quotation_id' => $quotationId,
            'comment' => $request->comment,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('freelancer.quotations.show', $quotationId)
            ->with('success', 'Comment added successfully.');
    }
}
