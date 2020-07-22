<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Disputes;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;
use Webmozart\Assert\Assert;

/**
 * The dispute details.
 *
 * generated from: referred-referred_dispute_summary.json
 */
class ReferredDisputeSummary implements JsonSerializable
{
    use BaseModel;

    /** The customer did not receive the merchandise or service. */
    const REASON_MERCHANDISE_OR_SERVICE_NOT_RECEIVED = 'MERCHANDISE_OR_SERVICE_NOT_RECEIVED';

    /** The customer reports that the merchandise or service is not as described. */
    const REASON_MERCHANDISE_OR_SERVICE_NOT_AS_DESCRIBED = 'MERCHANDISE_OR_SERVICE_NOT_AS_DESCRIBED';

    /** The dispute is open. */
    const STATUS_OPEN = 'OPEN';

    /** The dispute is resolved. */
    const STATUS_CLOSED = 'CLOSED';

    /** A third-party claim. The dispute requires custom handling. */
    const DISPUTE_FLOW_THIRD_PARTY_CLAIM = 'THIRD_PARTY_CLAIM';

    /** A third-party dispute. The dispute does not require any special handling. Defaults to default procedures. */
    const DISPUTE_FLOW_THIRD_PARTY_DISPUTE = 'THIRD_PARTY_DISPUTE';

    /**
     * @var string
     * The ID of the PayPal-side dispute.
     *
     * minLength: 6
     * maxLength: 20
     */
    public $dispute_id;

    /**
     * @var string
     * The date and time, in [Internet date and time format](https://tools.ietf.org/html/rfc3339#section-5.6).
     * Seconds are required while fractional seconds are optional.<blockquote><strong>Note:</strong> The regular
     * expression provides guidance but does not reject all invalid dates.</blockquote>
     *
     * minLength: 20
     * maxLength: 64
     */
    public $create_time;

    /**
     * @var string
     * The date and time, in [Internet date and time format](https://tools.ietf.org/html/rfc3339#section-5.6).
     * Seconds are required while fractional seconds are optional.<blockquote><strong>Note:</strong> The regular
     * expression provides guidance but does not reject all invalid dates.</blockquote>
     *
     * minLength: 20
     * maxLength: 64
     */
    public $update_time;

    /**
     * @var ReferenceDispute[]
     * The details about the partner disputes.
     */
    public $reference_disputes;

    /**
     * @var Money
     * The currency and amount for a financial transaction, such as a balance or payment due.
     */
    public $dispute_amount;

    /**
     * @var string
     * The reason for the item-level dispute. For information about the required information for each dispute reason
     * and associated evidence type, see <a
     * href="/docs/integration/direct/customer-disputes/integration-guide/#dispute-reasons">dispute reasons</a>.
     *
     * use one of constants defined in this class to set the value:
     * @see REASON_MERCHANDISE_OR_SERVICE_NOT_RECEIVED
     * @see REASON_MERCHANDISE_OR_SERVICE_NOT_AS_DESCRIBED
     * minLength: 1
     * maxLength: 255
     */
    public $reason;

    /**
     * @var string
     * The dispute status.
     *
     * use one of constants defined in this class to set the value:
     * @see STATUS_OPEN
     * @see STATUS_CLOSED
     * minLength: 1
     * maxLength: 255
     */
    public $status;

    /**
     * @var string
     * The dispute flow name.
     *
     * use one of constants defined in this class to set the value:
     * @see DISPUTE_FLOW_THIRD_PARTY_CLAIM
     * @see DISPUTE_FLOW_THIRD_PARTY_DISPUTE
     * minLength: 1
     * maxLength: 255
     */
    public $dispute_flow;

    /**
     * @var LinkDescription[]
     * An array of request-related [HATEOAS links](/docs/api/hateoas-links/).
     */
    public $links;

    public function validate($from = null)
    {
        $within = isset($from) ? "within $from" : "";
        !isset($this->dispute_id) || Assert::minLength($this->dispute_id, 6, "dispute_id in ReferredDisputeSummary must have minlength of 6 $within");
        !isset($this->dispute_id) || Assert::maxLength($this->dispute_id, 20, "dispute_id in ReferredDisputeSummary must have maxlength of 20 $within");
        !isset($this->create_time) || Assert::minLength($this->create_time, 20, "create_time in ReferredDisputeSummary must have minlength of 20 $within");
        !isset($this->create_time) || Assert::maxLength($this->create_time, 64, "create_time in ReferredDisputeSummary must have maxlength of 64 $within");
        !isset($this->update_time) || Assert::minLength($this->update_time, 20, "update_time in ReferredDisputeSummary must have minlength of 20 $within");
        !isset($this->update_time) || Assert::maxLength($this->update_time, 64, "update_time in ReferredDisputeSummary must have maxlength of 64 $within");
        !isset($this->reference_disputes) || Assert::isArray($this->reference_disputes, "reference_disputes in ReferredDisputeSummary must be array $within");

                                if (isset($this->reference_disputes)){
                                    foreach ($this->reference_disputes as $item) {
                                        $item->validate(ReferredDisputeSummary::class);
                                    }
                                }

        !isset($this->dispute_amount) || Assert::isInstanceOf($this->dispute_amount, Money::class, "dispute_amount in ReferredDisputeSummary must be instance of Money $within");
        !isset($this->dispute_amount) || $this->dispute_amount->validate(ReferredDisputeSummary::class);
        !isset($this->reason) || Assert::minLength($this->reason, 1, "reason in ReferredDisputeSummary must have minlength of 1 $within");
        !isset($this->reason) || Assert::maxLength($this->reason, 255, "reason in ReferredDisputeSummary must have maxlength of 255 $within");
        !isset($this->status) || Assert::minLength($this->status, 1, "status in ReferredDisputeSummary must have minlength of 1 $within");
        !isset($this->status) || Assert::maxLength($this->status, 255, "status in ReferredDisputeSummary must have maxlength of 255 $within");
        !isset($this->dispute_flow) || Assert::minLength($this->dispute_flow, 1, "dispute_flow in ReferredDisputeSummary must have minlength of 1 $within");
        !isset($this->dispute_flow) || Assert::maxLength($this->dispute_flow, 255, "dispute_flow in ReferredDisputeSummary must have maxlength of 255 $within");
        !isset($this->links) || Assert::isArray($this->links, "links in ReferredDisputeSummary must be array $within");

                                if (isset($this->links)){
                                    foreach ($this->links as $item) {
                                        $item->validate(ReferredDisputeSummary::class);
                                    }
                                }
    }

    public function __construct()
    {
    }
}
