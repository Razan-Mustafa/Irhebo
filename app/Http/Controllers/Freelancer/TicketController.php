<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TicketController extends Controller
{
    protected $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    public function index()
    {
        $tickets = $this->ticketService->getUserTickets(auth()->id());
        return view('pages-freelancer.tickets.index', compact('tickets'));
    }
    public function show($id)
    {
        $ticket = $this->ticketService->getTicketById($id);
        return view('pages-freelancer.tickets.show', compact('ticket'));
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

        return redirect()->route('freelancer.tickets.show', $ticket->id)
            ->with('success', __('Reply Sent Successfully'));
    }


    public function changeStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => ['required', Rule::in(['open', 'closed'])],
        ]);

        $ticket->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Ticket status updated successfully.');
    }
}
