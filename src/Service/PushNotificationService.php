<?php

namespace  Srleach\Pushr\Service;

use Srleach\Pushr\Adapters\ParsePushNotificationAdapter;
use Srleach\Pushr\PushNotification;
/**
 * Push notification Service.
 *
 * Class PushNotificationService
 * @package Srleach\Pushr\Service
 * @author Sean Leach <sean.leachy@icloud.com>
 */
class PushNotificationService
{
    /**
     * Determine which provider to use when sending a push notification.
     *
     * This function will always return the parse handler at present, but, if this ever needs to change,
     * it's a case of passing the conditions into the constructor and adding a condition into the switch stmt.
     *
     * @return ParsePushNotificationAdapter
     * @throws \Exception
     */
    private function getPushInfrastructureProvider()
    {
        switch (1) {
            case 1:
                return new ParsePushNotificationAdapter();
            default:
                throw new \Exception('Could not determine which notification provider to use.');
        }
    }

    /**
     * Send the push notification, while selecting which provider to use for it.
     *
     * @param PushNotification $pushNotification
     * @todo Move the logic to determine push handler into push entity, so multiple providers can be used and created.
     * @return bool
     * @throws \Exception
     */
    public static function send(PushNotification $pushNotification)
    {
        $service = new self;

        $provider = $service->getPushInfrastructureProvider();

        $provider->send($pushNotification);

        return true;
    }

    /**
     * Create a new push notification. Helper to allow a nice fluent way of creating without instantiating every class
     * and his dog.
     *
     * @return PushNotification
     */
    public static function createPush()
    {
        return new PushNotification();
    }
}