<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Disputes;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;
use Webmozart\Assert\Assert;

/**
 * The merchant request to send a message to the other party.
 *
 * generated from: request-send_message.json
 */
class SendMessage implements JsonSerializable
{
    use BaseModel;

    /**
     * The message sent by the merchant to the other party.
     *
     * @var string
     * minLength: 1
     * maxLength: 2000
     */
    public $message;

    public function validate($from = null)
    {
        $within = isset($from) ? "within $from" : "";
        Assert::notNull($this->message, "message in SendMessage must not be NULL $within");
        Assert::minLength(
            $this->message,
            1,
            "message in SendMessage must have minlength of 1 $within"
        );
        Assert::maxLength(
            $this->message,
            2000,
            "message in SendMessage must have maxlength of 2000 $within"
        );
    }

    private function map(array $data)
    {
        if (isset($data['message'])) {
            $this->message = $data['message'];
        }
    }

    public function __construct(array $data = null)
    {
        if (isset($data)) { $this->map($data); }
    }
}
