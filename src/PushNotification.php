<?php

namespace Srleach\Pushr;

/**
 * Class PushNotification
 *
 * Wrapper for a push notification. We'll use this to set the content, any custom payloads and targeting.
 *
 * @author Sean Leach <sean.leachy@icloud.com>
 */
class PushNotification
{
    private $targetChannel;
    private $targetMessage;
    private $targetCustomPayload;

    /**
     * Set a simple message to be sent to the user(s).
     *
     * Overrides others.
     *
     * @param $message
     * @return $this
     */
    public function withMessage($message)
    {
        $this->targetMessage = $message;
        $this->targetCustomPayload = false;

        return $this;
    }

    /**
     * Set a custom payload on the push. This will override any message.
     * @param array $payload
     * @return $this
     */
    public function withCustomPayload(array $payload)
    {
        $this->targetCustomPayload = $payload;
        $this->targetMessage = false;

        return $this;
    }
    
    /**
     * Set the User ID we'll target
     * @param $recipient The user's ID in your storage of choice. They'll have to be subscribed to this channel.
     * @return $this
     */
    public function toUser($recipient)
    {
        $this->targetChannel = $recipient;

        return $this;
    }

    /**
     * Check the push is ready to send. If so, we can despatch it into the adapter.
     *
     * @return bool
     * @throws \Exception
     */
    private function validateIsSuitableForSending()
    {
        if (is_null($this->targetChannel)) {

            throw new \Exception('You must address a push notification to a user.');
        }

        //TODO: check for at least one of the payloads being set.
        if (is_null($this->targetChannel)) {

            throw new \Exception('You must set either the message or a custom payload.');
        }

        return true;
    }

    /**
     * Called by the Adapter to send the data.
     */
    public function getData()
    {
        try {

            $this->validateIsSuitableForSending();
        } catch (\Exception $e) {

            throw new \Exception('Cannot send the push: ' . $e->getMessage());
        }

        return [
            'targetChannel' => $this->targetChannel,
            'targetCustomPayload' => $this->targetCustomPayload,
            'targetMessage' => $this->targetMessage,
        ];
    }


}