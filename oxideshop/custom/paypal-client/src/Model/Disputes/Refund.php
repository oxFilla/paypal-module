<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Disputes;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;
use Webmozart\Assert\Assert;

/**
 * The refund details.
 *
 * generated from: response-refund.json
 */
class Refund implements JsonSerializable
{
    use BaseModel;

    /**
     * @var Money
     * The currency and amount for a financial transaction, such as a balance or payment due.
     */
    public $gross_amount;

    /**
     * @var string
     * The date and time, in [Internet date and time format](https://tools.ietf.org/html/rfc3339#section-5.6).
     * Seconds are required while fractional seconds are optional.<blockquote><strong>Note:</strong> The regular
     * expression provides guidance but does not reject all invalid dates.</blockquote>
     *
     * minLength: 20
     * maxLength: 64
     */
    public $transaction_time;

    /**
     * @var string
     * The ID of the transaction for the refund, as it appears to the merchant.
     *
     * minLength: 1
     * maxLength: 255
     */
    public $transaction_id;

    /**
     * @var string
     * The ID of the invoice for the refund.
     *
     * minLength: 1
     * maxLength: 127
     */
    public $invoice_number;

    public function validate($from = null)
    {
        $within = isset($from) ? "within $from" : "";
        !isset($this->gross_amount) || Assert::isInstanceOf($this->gross_amount, Money::class, "gross_amount in Refund must be instance of Money $within");
        !isset($this->gross_amount) || $this->gross_amount->validate(Refund::class);
        !isset($this->transaction_time) || Assert::minLength($this->transaction_time, 20, "transaction_time in Refund must have minlength of 20 $within");
        !isset($this->transaction_time) || Assert::maxLength($this->transaction_time, 64, "transaction_time in Refund must have maxlength of 64 $within");
        !isset($this->transaction_id) || Assert::minLength($this->transaction_id, 1, "transaction_id in Refund must have minlength of 1 $within");
        !isset($this->transaction_id) || Assert::maxLength($this->transaction_id, 255, "transaction_id in Refund must have maxlength of 255 $within");
        !isset($this->invoice_number) || Assert::minLength($this->invoice_number, 1, "invoice_number in Refund must have minlength of 1 $within");
        !isset($this->invoice_number) || Assert::maxLength($this->invoice_number, 127, "invoice_number in Refund must have maxlength of 127 $within");
    }

    public function __construct()
    {
    }
}
