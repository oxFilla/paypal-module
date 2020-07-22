<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Subscriptions;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;
use Webmozart\Assert\Assert;

/**
 * The pricing scheme details.
 *
 * generated from: pricing_scheme.json
 */
class PricingScheme implements JsonSerializable
{
    use BaseModel;

    /** The pricing scheme change is in progress. */
    const STATUS_IN_PROGRESS = 'IN_PROGRESS';

    /** The pricing scheme change is active. */
    const STATUS_ACTIVE = 'ACTIVE';

    /** The pricing scheme is inactive. */
    const STATUS_INACTIVE = 'INACTIVE';

    /** A volume-tiered model. */
    const TIER_MODE_VOLUME = 'VOLUME';

    /** A graduated-tiered model. */
    const TIER_MODE_GRADUATED = 'GRADUATED';

    /**
     * @var integer
     * The version of the pricing scheme.
     */
    public $version;

    /**
     * @var string
     * The status of the pricing scheme.
     *
     * use one of constants defined in this class to set the value:
     * @see STATUS_IN_PROGRESS
     * @see STATUS_ACTIVE
     * @see STATUS_INACTIVE
     * minLength: 1
     * maxLength: 24
     */
    public $status;

    /**
     * @var Money
     * The currency and amount for a financial transaction, such as a balance or payment due.
     */
    public $fixed_price;

    /**
     * @var string
     * The pricing model for tiered plan. The `tiers` parameter is required.
     *
     * use one of constants defined in this class to set the value:
     * @see TIER_MODE_VOLUME
     * @see TIER_MODE_GRADUATED
     * minLength: 1
     * maxLength: 24
     */
    public $tier_mode;

    /**
     * @var array<PricingTier>
     * An array of pricing tiers which are used for billing volume/graduated plans. tier_mode field has to be
     * specified.
     *
     * this is mandatory to be set
     * maxItems: 1
     * maxItems: 32
     */
    public $tiers;

    /**
     * @var RollOutStrategy
     * The roll-out strategy for a pricing scheme update. After the pricing update, all new subscriptions are based
     * on this pricing scheme and the values in this object determine the behavior for the existing subscriptions.
     */
    public $roll_out_strategy;

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

    public function validate($from = null)
    {
        $within = isset($from) ? "within $from" : "";
        !isset($this->status) || Assert::minLength($this->status, 1, "status in PricingScheme must have minlength of 1 $within");
        !isset($this->status) || Assert::maxLength($this->status, 24, "status in PricingScheme must have maxlength of 24 $within");
        !isset($this->fixed_price) || Assert::isInstanceOf($this->fixed_price, Money::class, "fixed_price in PricingScheme must be instance of Money $within");
        !isset($this->fixed_price) || $this->fixed_price->validate(PricingScheme::class);
        !isset($this->tier_mode) || Assert::minLength($this->tier_mode, 1, "tier_mode in PricingScheme must have minlength of 1 $within");
        !isset($this->tier_mode) || Assert::maxLength($this->tier_mode, 24, "tier_mode in PricingScheme must have maxlength of 24 $within");
        Assert::notNull($this->tiers, "tiers in PricingScheme must not be NULL $within");
         Assert::minCount($this->tiers, 1, "tiers in PricingScheme must have min. count of 1 $within");
         Assert::maxCount($this->tiers, 32, "tiers in PricingScheme must have max. count of 32 $within");
         Assert::isArray($this->tiers, "tiers in PricingScheme must be array $within");

                                if (isset($this->tiers)){
                                    foreach ($this->tiers as $item) {
                                        $item->validate(PricingScheme::class);
                                    }
                                }

        !isset($this->roll_out_strategy) || Assert::isInstanceOf($this->roll_out_strategy, RollOutStrategy::class, "roll_out_strategy in PricingScheme must be instance of RollOutStrategy $within");
        !isset($this->roll_out_strategy) || $this->roll_out_strategy->validate(PricingScheme::class);
        !isset($this->create_time) || Assert::minLength($this->create_time, 20, "create_time in PricingScheme must have minlength of 20 $within");
        !isset($this->create_time) || Assert::maxLength($this->create_time, 64, "create_time in PricingScheme must have maxlength of 64 $within");
        !isset($this->update_time) || Assert::minLength($this->update_time, 20, "update_time in PricingScheme must have minlength of 20 $within");
        !isset($this->update_time) || Assert::maxLength($this->update_time, 64, "update_time in PricingScheme must have maxlength of 64 $within");
    }

    public function __construct()
    {
    }
}
