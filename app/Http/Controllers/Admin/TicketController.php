<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    protected $ticketService;

    public function __construct(TicketService $ticketService){
        $this->ticketService = $ticketService;
    }
   
    public function index(){
        $tickets = $this->ticketService->getAllTickets();
        return view('pages.tickets.index',compact('tickets'));
    }
    public function show($id){
        $ticket = $this->ticketService->getTicketById($id);
        return view('pages.tickets.show', compact('ticket'));
    }
    public function reply(Request $request, $ticketId)
    {
        $request->validate([
            'message' => 'required|string',
            'attachment' => 'nullable|array',
            'attachment.*' => 'file|mimes:jpg,jpeg,png,pdf,docx',
        ]);

        $ticket = $this->ticketService->getTicketById($ticketId);

        $this->ticketService->addMessage([
            'ticket_id' => $ticket->id,
            'message' => $request->message,
            'attachment' => $request->file('attachment'),
        ], auth()->user());

        return redirect()->route('tickets.show', $ticket->id)
            ->with('success', __('Reply Sent Successfully'));
    }
}
