<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Disputes;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;
use Webmozart\Assert\Assert;

/**
 * The evidence-related information.
 *
 * generated from: response-evidence_info.json
 */
class EvidenceInfo implements JsonSerializable
{
    use BaseModel;

    /**
     * An array of relevant tracking information for the transaction involved in this dispute.
     *
     * @var TrackingInfo[] | null
     */
    public $tracking_info;

    /**
     * An array of refund IDs for the transaction involved in this dispute.
     *
     * @var string[] | null
     */
    public $refund_ids;

    public function validate($from = null)
    {
        $within = isset($from) ? "within $from" : "";
        !isset($this->tracking_info) || Assert::isArray(
            $this->tracking_info,
            "tracking_info in EvidenceInfo must be array $within"
        );
        if (isset($this->tracking_info)) {
            foreach ($this->tracking_info as $item) {
                $item->validate(EvidenceInfo::class);
            }
        }
        !isset($this->refund_ids) || Assert::isArray(
            $this->refund_ids,
            "refund_ids in EvidenceInfo must be array $within"
        );
    }

    private function map(array $data)
    {
        if (isset($data['tracking_info'])) {
            $this->tracking_info = [];
            foreach ($data['tracking_info'] as $item) {
                $this->tracking_info[] = new TrackingInfo($item);
            }
        }
        if (isset($data['refund_ids'])) {
            $this->refund_ids = [];
            foreach ($data['refund_ids'] as $item) {
                $this->refund_ids[] = $item;
            }
        }
    }

    public function __construct(array $data = null)
    {
        if (isset($data)) { $this->map($data); }
    }
}
