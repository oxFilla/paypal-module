<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Partner;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;
use OxidProfessionalServices\PayPal\Api\Model\CommonV4\LinkDescription;
use Webmozart\Assert\Assert;

/**
 * The share referral data response.
 *
 * generated from: referral_data-referral_data_response.json
 */
class ReferralDataResponse implements JsonSerializable
{
    use BaseModel;

    /**
     * The ID to access the customer's data shared by the partner with PayPal.
     *
     * @var string | null
     */
    public $partner_referral_id;

    /**
     * The payer ID of the partner who shared the referral data.
     *
     * @var string | null
     */
    public $submitter_payer_id;

    /**
     * The customer's referral data that partners share with PayPal.
     *
     * @var ReferralData | null
     */
    public $referral_data;

    /**
     * An array of request-related [HATEOAS links](/docs/api/overview/#hateoas-links).
     *
     * @var LinkDescription[]
     * maxItems: 0
     * maxItems: 2
     */
    public $links;

    public function validate($from = null)
    {
        $within = isset($from) ? "within $from" : "";
        !isset($this->referral_data) || Assert::isInstanceOf(
            $this->referral_data,
            ReferralData::class,
            "referral_data in ReferralDataResponse must be instance of ReferralData $within"
        );
        !isset($this->referral_data) ||  $this->referral_data->validate(ReferralDataResponse::class);
        Assert::notNull($this->links, "links in ReferralDataResponse must not be NULL $within");
        Assert::minCount(
            $this->links,
            0,
            "links in ReferralDataResponse must have min. count of 0 $within"
        );
        Assert::maxCount(
            $this->links,
            2,
            "links in ReferralDataResponse must have max. count of 2 $within"
        );
        Assert::isArray(
            $this->links,
            "links in ReferralDataResponse must be array $within"
        );
        if (isset($this->links)) {
            foreach ($this->links as $item) {
                $item->validate(ReferralDataResponse::class);
            }
        }
    }

    private function map(array $data)
    {
        if (isset($data['partner_referral_id'])) {
            $this->partner_referral_id = $data['partner_referral_id'];
        }
        if (isset($data['submitter_payer_id'])) {
            $this->submitter_payer_id = $data['submitter_payer_id'];
        }
        if (isset($data['referral_data'])) {
            $this->referral_data = new ReferralData($data['referral_data']);
        }
        if (isset($data['links'])) {
            $this->links = [];
            foreach ($data['links'] as $item) {
                $this->links[] = new LinkDescription($item);
            }
        }
    }

    public function __construct(array $data = null)
    {
        $this->links = [];
        if (isset($data)) { $this->map($data); }
    }
}
