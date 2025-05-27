<?php

namespace App\Services;

use App\Repositories\Interfaces\TicketRepositoryInterface;
use App\Utilities\FileManager;
use App\Utilities\GenerateCode;

class TicketService
{
    protected TicketRepositoryInterface $ticketRepository;

    public function __construct(TicketRepositoryInterface $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function getAllTickets()
    {
        return $this->ticketRepository->getAllTickets();
    }

    public function getUserTickets($userId)
    {
        return $this->ticketRepository->getUserTickets($userId);
    }

    public function getTicketById($id)
    {
        return $this->ticketRepository->getTicketById($id);
    }

    public function createTicket(array $data, $user)
    {
        $data['user_id'] = $user->id;
        $data['status'] = 'open';
        $data['code'] = GenerateCode::generateTicketCode();
        $ticket = $this->ticketRepository->createTicket($data);

        if (!empty($data['message'])) {
            $this->addMessage([
                'ticket_id' => $ticket->id,
                'user_id' => $user->id,
                'message' => $data['message'],
                'attachment' => $data['attachment'] ?? null
            ], $user);
        }

        return $ticket->load(['messages.attachments']);
    }

    public function addMessage(array $data, $user)
    {
        $message = $this->ticketRepository->addMessage($data['ticket_id'], [
            'user_id' => $user->id,
            'message' => $data['message'],
            'is_admin' => false
        ], $user);

        if (!empty($data['attachment'])) {
            $this->handleAttachment($message->id, $data['attachment'], $user->id);
        }

        return $message->load('attachments');
    }

    protected function handleAttachment($messageId, $files, $userId)
    {
        if (is_array($files)) {
            foreach ($files as $file) {
                $this->uploadAndAttach($messageId, $file, $userId);
            }
        } else {
            $this->uploadAndAttach($messageId, $files, $userId);
        }
    }

    protected function uploadAndAttach($messageId, $file, $userId)
    {
        $path = FileManager::upload('tickets', $file);
        $this->ticketRepository->addAttachment($messageId, [
            'user_id' => $userId,
            'file_path' => $path,
            'file_type' => FileManager::getFileTypeFromPath($path)
        ]);
    }

    public function closeTicket($ticketId)
    {
        return $this->ticketRepository->closeTicket($this->getTicketById($ticketId));
    }
}
