<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Subscriptions;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;
use Webmozart\Assert\Assert;

/**
 * The update pricing scheme request details.
 *
 * generated from: update_pricing_schemes_list_request.json
 */
class UpdatePricingSchemesListRequest implements JsonSerializable
{
    use BaseModel;

    /**
     * @var UpdatePricingSchemeRequest[]
     * An array of pricing schemes.
     *
     * this is mandatory to be set
     * maxItems: 1
     * maxItems: 99
     */
    public $pricing_schemes;

    public function validate($from = null)
    {
        $within = isset($from) ? "within $from" : "";
        Assert::notNull($this->pricing_schemes, "pricing_schemes in UpdatePricingSchemesListRequest must not be NULL $within");
         Assert::minCount($this->pricing_schemes, 1, "pricing_schemes in UpdatePricingSchemesListRequest must have min. count of 1 $within");
         Assert::maxCount($this->pricing_schemes, 99, "pricing_schemes in UpdatePricingSchemesListRequest must have max. count of 99 $within");
         Assert::isArray($this->pricing_schemes, "pricing_schemes in UpdatePricingSchemesListRequest must be array $within");

                                if (isset($this->pricing_schemes)){
                                    foreach ($this->pricing_schemes as $item) {
                                        $item->validate(UpdatePricingSchemesListRequest::class);
                                    }
                                }
    }

    public function __construct()
    {
    }
}
