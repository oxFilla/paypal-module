<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Disputes;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;
use OxidProfessionalServices\PayPal\Api\Model\CommonV3\LinkDescription;
use Webmozart\Assert\Assert;

/**
 * An array of disputes. Includes links that enable you to navigate through the response.
 *
 * generated from: response-dispute_search.json
 */
class DisputeSearch implements JsonSerializable
{
    use BaseModel;

    /**
     * An array of disputes that match the filter criteria. Sorted in latest to earliest creation time order.
     *
     * @var DisputeInfo[] | null
     */
    public $items;

    /**
     * The total number of items. If the request specifies `total_required=true`, appears in the response.
     *
     * @var int | null
     */
    public $total_items;

    /**
     * The total number of pages. If the request specifies `total_required=true`, appears in the response.
     *
     * @var int | null
     */
    public $total_pages;

    /**
     * An array of request-related [HATEOAS links](/docs/api/hateoas-links/).
     *
     * @var LinkDescription[] | null
     */
    public $links;

    public function validate($from = null)
    {
        $within = isset($from) ? "within $from" : "";
        !isset($this->items) || Assert::isArray(
            $this->items,
            "items in DisputeSearch must be array $within"
        );
        if (isset($this->items)) {
            foreach ($this->items as $item) {
                $item->validate(DisputeSearch::class);
            }
        }
        !isset($this->links) || Assert::isArray(
            $this->links,
            "links in DisputeSearch must be array $within"
        );
        if (isset($this->links)) {
            foreach ($this->links as $item) {
                $item->validate(DisputeSearch::class);
            }
        }
    }

    private function map(array $data)
    {
        if (isset($data['items'])) {
            $this->items = [];
            foreach ($data['items'] as $item) {
                $this->items[] = new DisputeInfo($item);
            }
        }
        if (isset($data['total_items'])) {
            $this->total_items = $data['total_items'];
        }
        if (isset($data['total_pages'])) {
            $this->total_pages = $data['total_pages'];
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
        if (isset($data)) { $this->map($data); }
    }
}
