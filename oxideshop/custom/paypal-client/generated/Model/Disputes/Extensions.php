<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Disputes;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;
use Webmozart\Assert\Assert;

/**
 * The extended properties for the dispute. Includes additional information for a dispute category, such as
 * billing disputes, the original transaction ID, and the correct amount.
 *
 * generated from: response-extensions.json
 */
class Extensions implements JsonSerializable
{
    use BaseModel;

    /** The merchant did not respond to the customer. */
    public const MERCHANT_CONTACTED_OUTCOME_NO_RESPONSE = 'NO_RESPONSE';

    /** The merchant agreed to fix the issue but did not fix it yet. */
    public const MERCHANT_CONTACTED_OUTCOME_FIXED = 'FIXED';

    /** The merchant could not fix the issue. */
    public const MERCHANT_CONTACTED_OUTCOME_NOT_FIXED = 'NOT_FIXED';

    /** The merchant was contacted through his website. */
    public const MERCHANT_CONTACTED_MODE_WEBSITE = 'WEBSITE';

    /** The merchant was contacted through either phone or fax. */
    public const MERCHANT_CONTACTED_MODE_PHONE = 'PHONE';

    /** The merchant was contacted through either email or text message. */
    public const MERCHANT_CONTACTED_MODE_EMAIL = 'EMAIL';

    /** The merchant was contacted through a written communication. */
    public const MERCHANT_CONTACTED_MODE_WRITTEN = 'WRITTEN';

    /** The merchant was contacted in person. */
    public const MERCHANT_CONTACTED_MODE_IN_PERSON = 'IN_PERSON';

    /**
     * Indicates that the merchant was contacted.
     *
     * @var boolean | null
     */
    public $merchant_contacted;

    /**
     * The outcome when the customer has contacted the merchant.
     *
     * use one of constants defined in this class to set the value:
     * @see MERCHANT_CONTACTED_OUTCOME_NO_RESPONSE
     * @see MERCHANT_CONTACTED_OUTCOME_FIXED
     * @see MERCHANT_CONTACTED_OUTCOME_NOT_FIXED
     * @var string | null
     * minLength: 1
     * maxLength: 255
     */
    public $merchant_contacted_outcome;

    /**
     * The date and time, in [Internet date and time format](https://tools.ietf.org/html/rfc3339#section-5.6).
     * Seconds are required while fractional seconds are optional.<blockquote><strong>Note:</strong> The regular
     * expression provides guidance but does not reject all invalid dates.</blockquote>
     *
     * @var string | null
     * minLength: 20
     * maxLength: 64
     */
    public $merchant_contacted_time;

    /**
     * The method used to contact the merchant.
     *
     * use one of constants defined in this class to set the value:
     * @see MERCHANT_CONTACTED_MODE_WEBSITE
     * @see MERCHANT_CONTACTED_MODE_PHONE
     * @see MERCHANT_CONTACTED_MODE_EMAIL
     * @see MERCHANT_CONTACTED_MODE_WRITTEN
     * @see MERCHANT_CONTACTED_MODE_IN_PERSON
     * @var string | null
     * minLength: 1
     * maxLength: 255
     */
    public $merchant_contacted_mode;

    /**
     * The date and time, in [Internet date and time format](https://tools.ietf.org/html/rfc3339#section-5.6).
     * Seconds are required while fractional seconds are optional.<blockquote><strong>Note:</strong> The regular
     * expression provides guidance but does not reject all invalid dates.</blockquote>
     *
     * @var string | null
     * minLength: 20
     * maxLength: 64
     */
    public $buyer_contacted_time;

    /**
     * The billing issue details.
     *
     * @var BillingDisputesProperties | null
     */
    public $billing_dispute_properties;

    /**
     * The customer-entered issue details for an unauthorized dispute.
     *
     * @var UnauthorizedDisputeProperties | null
     */
    public $unauthorized_dispute_properties;

    /**
     * The customer-provided merchandise issue details for the dispute.
     *
     * @var MerchandizeDisputeProperties | null
     */
    public $merchandize_dispute_properties;

    /**
     * The third-party claims properties.
     *
     * @var ExternalCaseProperties | null
     */
    public $external_case_properties;

    public function validate($from = null)
    {
        $within = isset($from) ? "within $from" : "";
        !isset($this->merchant_contacted_outcome) || Assert::minLength(
            $this->merchant_contacted_outcome,
            1,
            "merchant_contacted_outcome in Extensions must have minlength of 1 $within"
        );
        !isset($this->merchant_contacted_outcome) || Assert::maxLength(
            $this->merchant_contacted_outcome,
            255,
            "merchant_contacted_outcome in Extensions must have maxlength of 255 $within"
        );
        !isset($this->merchant_contacted_time) || Assert::minLength(
            $this->merchant_contacted_time,
            20,
            "merchant_contacted_time in Extensions must have minlength of 20 $within"
        );
        !isset($this->merchant_contacted_time) || Assert::maxLength(
            $this->merchant_contacted_time,
            64,
            "merchant_contacted_time in Extensions must have maxlength of 64 $within"
        );
        !isset($this->merchant_contacted_mode) || Assert::minLength(
            $this->merchant_contacted_mode,
            1,
            "merchant_contacted_mode in Extensions must have minlength of 1 $within"
        );
        !isset($this->merchant_contacted_mode) || Assert::maxLength(
            $this->merchant_contacted_mode,
            255,
            "merchant_contacted_mode in Extensions must have maxlength of 255 $within"
        );
        !isset($this->buyer_contacted_time) || Assert::minLength(
            $this->buyer_contacted_time,
            20,
            "buyer_contacted_time in Extensions must have minlength of 20 $within"
        );
        !isset($this->buyer_contacted_time) || Assert::maxLength(
            $this->buyer_contacted_time,
            64,
            "buyer_contacted_time in Extensions must have maxlength of 64 $within"
        );
        !isset($this->billing_dispute_properties) || Assert::isInstanceOf(
            $this->billing_dispute_properties,
            BillingDisputesProperties::class,
            "billing_dispute_properties in Extensions must be instance of BillingDisputesProperties $within"
        );
        !isset($this->billing_dispute_properties) ||  $this->billing_dispute_properties->validate(Extensions::class);
        !isset($this->unauthorized_dispute_properties) || Assert::isInstanceOf(
            $this->unauthorized_dispute_properties,
            UnauthorizedDisputeProperties::class,
            "unauthorized_dispute_properties in Extensions must be instance of UnauthorizedDisputeProperties $within"
        );
        !isset($this->unauthorized_dispute_properties) ||  $this->unauthorized_dispute_properties->validate(Extensions::class);
        !isset($this->merchandize_dispute_properties) || Assert::isInstanceOf(
            $this->merchandize_dispute_properties,
            MerchandizeDisputeProperties::class,
            "merchandize_dispute_properties in Extensions must be instance of MerchandizeDisputeProperties $within"
        );
        !isset($this->merchandize_dispute_properties) ||  $this->merchandize_dispute_properties->validate(Extensions::class);
        !isset($this->external_case_properties) || Assert::isInstanceOf(
            $this->external_case_properties,
            ExternalCaseProperties::class,
            "external_case_properties in Extensions must be instance of ExternalCaseProperties $within"
        );
        !isset($this->external_case_properties) ||  $this->external_case_properties->validate(Extensions::class);
    }

    private function map(array $data)
    {
        if (isset($data['merchant_contacted'])) {
            $this->merchant_contacted = $data['merchant_contacted'];
        }
        if (isset($data['merchant_contacted_outcome'])) {
            $this->merchant_contacted_outcome = $data['merchant_contacted_outcome'];
        }
        if (isset($data['merchant_contacted_time'])) {
            $this->merchant_contacted_time = $data['merchant_contacted_time'];
        }
        if (isset($data['merchant_contacted_mode'])) {
            $this->merchant_contacted_mode = $data['merchant_contacted_mode'];
        }
        if (isset($data['buyer_contacted_time'])) {
            $this->buyer_contacted_time = $data['buyer_contacted_time'];
        }
        if (isset($data['billing_dispute_properties'])) {
            $this->billing_dispute_properties = new BillingDisputesProperties($data['billing_dispute_properties']);
        }
        if (isset($data['unauthorized_dispute_properties'])) {
            $this->unauthorized_dispute_properties = new UnauthorizedDisputeProperties($data['unauthorized_dispute_properties']);
        }
        if (isset($data['merchandize_dispute_properties'])) {
            $this->merchandize_dispute_properties = new MerchandizeDisputeProperties($data['merchandize_dispute_properties']);
        }
        if (isset($data['external_case_properties'])) {
            $this->external_case_properties = new ExternalCaseProperties($data['external_case_properties']);
        }
    }

    public function __construct(array $data = null)
    {
        if (isset($data)) { $this->map($data); }
    }
}
