<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\PlayerId;
use App\Services\OneSignalService;
use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    protected $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    public function index()
    {
        $tickets = $this->ticketService->getAllTickets();
        return view('pages.tickets.index', compact('tickets'));
    }
    public function show($id)
    {
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


        // one signal notification
        $user =$ticket->user;
        if ($user) {
            $playerIdRecord = PlayerId::where('user_id', $user->id)
                ->where('is_notifiable', 1)
                ->pluck('player_id')->toArray();


            if ($playerIdRecord) {
                $titles = [
                    'en' => __('support_ticket_update_title', [], 'en'),
                    'ar' => __('support_ticket_update_title', [], 'ar'),
                ];

                $messages = [
                    'en' => __('support_ticket_update_message', [], 'en'),
                    'ar' => __('support_ticket_update_message', [], 'ar'),
                ];

                $response = app(OneSignalService::class)->sendNotificationToUser(
                    $playerIdRecord, // نرسل player_id من جدول player_ids
                    $titles,
                    $messages
                );

                Notification::create([
                    'user_id'           => $user->id,
                    'title'             => json_encode($titles),
                    'body'              => json_encode($messages),
                    'type'              => 'support',
                    'type_id'           => $ticket->id,
                    'is_read'           => false,
                    'onesignal_id'      => $response['id'] ?? null,
                    'response_onesignal' => json_encode($response),
                ]);
            }
        }
        // *********************************************//



        return redirect()->route('tickets.show', $ticket->id)
            ->with('success', __('Reply Sent Successfully'));
    }
}
