<?php

namespace Srleach\Pushr\Adapters;

use Srleach\Pushr\PushNotification;
use Parse\ParseClient;
use Parse\ParsePush;

/**
 * Adapter to send push via Parse.
 *
 * This honours the PushNotificationAdapter Interface in order to allow an easy switch to another platform
 * if ever required. Alternatives include Amazon SNS, Firebase, etc.
 *
 * Class ParsePushNotificationAdapter
 * @package Srleach\Pushr\Adapters
 */
class ParsePushNotificationAdapter
{
    /**
     * Construct our adapter by gleaning the keys from the ENV params.
     * These can be set in the .env file, or set as environment vars on a production server.
     */
    public function __construct()
    {
        $app_id = env('PARSE_APP_APID');
        $rest_key = env('PARSE_APP_REST');
        $master_key = env('PARSE_APP_MAST');

        ParseClient::initialize( $app_id, $rest_key, $master_key );
    }

    /**
     * Send the push notification.
     *
     * @param PushNotification $push
     * @throws \Exception
     */
    public function send(PushNotification $push)
    {
        ParsePush::send($this->formatExternalPushData($push->getData()));
    }


    /**
     * Format the data from PushNotification to the expected format of the parse push service.
     *
     * @param array $pushData
     * @return array
     */
    private function formatExternalPushData(array $pushData)
    {
        $payload = [
            'channels' => [$pushData['targetChannel']],
        ];

        if (!$pushData['targetCustomPayload']) {

            $payload['data'] = [
                'alert' => $pushData['targetMessage']
            ];
        }else{

            $payload['data'] = $pushData['targetCustomPayload'];
        }

        return $payload;
    }
}