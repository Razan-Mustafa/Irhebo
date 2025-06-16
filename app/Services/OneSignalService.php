<?php

namespace App\Services;

use Berkayk\OneSignal\OneSignalFacade as OneSignal;

class OneSignalService
{
    /**
     * Send a push notification to a specific user by player ID.
     *
     * @param string $playerId
     * @param string $title
     * @param string $message
     * @return void
     */
    public function sendNotificationToUser(array $playerId, array $titles, array $messages)
    {
        $response = OneSignal::sendNotificationCustom([
            'include_player_ids' => $playerId,
            'headings' => [
                'en' => $titles['en'],
                'ar' => $titles['ar'],
            ],
            'contents' => [
                'en' => $messages['en'],
                'ar' => $messages['ar'],
            ],
        ]);
        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);
        \Log::info('OneSignal response', $data);

        return $data;

        // return json_decode($body, true); // 👈 decode it to array
    }


    /**
     * Send a push notification to all users.
     *
     * @param string $title
     * @param string $message
     * @return void
     */
    // public function sendNotificationToAll(string $title, string $message): void
    // {
    //     OneSignal::sendNotificationCustom([
    //         'included_segments' => ['All'],
    //         'headings' => ['en' => (string)$title],
    //         'contents' => ['en' => (string)$message],
    //     ]);
    // }
}
