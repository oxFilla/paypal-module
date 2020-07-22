<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Orders;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;
use Webmozart\Assert\Assert;

/**
 * The details for the items to be purchased.
 *
 * generated from: MerchantsCommonComponentsSpecification-v1-schema-item.json
 */
class Item implements JsonSerializable
{
    use BaseModel;

    /** Goods that are stored, delivered, and used in their electronic format. This value is not currently supported for API callers that leverage the [PayPal for Commerce Platform](https://www.paypal.com/us/webapps/mpp/commerce-platform) product. */
    const CATEGORY_DIGITAL_GOODS = 'DIGITAL_GOODS';

    /** A tangible item that can be shipped with proof of delivery. */
    const CATEGORY_PHYSICAL_GOODS = 'PHYSICAL_GOODS';

    /** A contribution or gift for which no good or service is exchanged, usually to a not for profit organization. This category is restricted to approved API Callers and Payee. Please speak to your account manager if you want to process this type of items. */
    const CATEGORY_DONATION = 'DONATION';

    /**
     * @var string
     * The item name or title.
     *
     * this is mandatory to be set
     * minLength: 1
     * maxLength: 127
     */
    public $name;

    /**
     * @var Money
     * The currency and amount for a financial transaction, such as a balance or payment due.
     *
     * this is mandatory to be set
     */
    public $unit_amount;

    /**
     * @var Money
     * The currency and amount for a financial transaction, such as a balance or payment due.
     */
    public $tax;

    /**
     * @var string
     * The item quantity. Must be a whole number.
     *
     * this is mandatory to be set
     * maxLength: 10
     */
    public $quantity;

    /**
     * @var string
     * The detailed item description.
     *
     * maxLength: 127
     */
    public $description;

    /**
     * @var string
     * The stock keeping unit (SKU) for the item.
     *
     * maxLength: 127
     */
    public $sku;

    /**
     * @var string
     * The item category type.
     *
     * use one of constants defined in this class to set the value:
     * @see CATEGORY_DIGITAL_GOODS
     * @see CATEGORY_PHYSICAL_GOODS
     * @see CATEGORY_DONATION
     * minLength: 1
     * maxLength: 20
     */
    public $category;

    public function validate($from = null)
    {
        $within = isset($from) ? "within $from" : "";
        Assert::notNull($this->name, "name in Item must not be NULL $within");
         Assert::minLength($this->name, 1, "name in Item must have minlength of 1 $within");
         Assert::maxLength($this->name, 127, "name in Item must have maxlength of 127 $within");
        Assert::notNull($this->unit_amount, "unit_amount in Item must not be NULL $within");
         Assert::isInstanceOf($this->unit_amount, Money::class, "unit_amount in Item must be instance of Money $within");
         $this->unit_amount->validate(Item::class);
        !isset($this->tax) || Assert::isInstanceOf($this->tax, Money::class, "tax in Item must be instance of Money $within");
        !isset($this->tax) || $this->tax->validate(Item::class);
        Assert::notNull($this->quantity, "quantity in Item must not be NULL $within");
         Assert::maxLength($this->quantity, 10, "quantity in Item must have maxlength of 10 $within");
        !isset($this->description) || Assert::maxLength($this->description, 127, "description in Item must have maxlength of 127 $within");
        !isset($this->sku) || Assert::maxLength($this->sku, 127, "sku in Item must have maxlength of 127 $within");
        !isset($this->category) || Assert::minLength($this->category, 1, "category in Item must have minlength of 1 $within");
        !isset($this->category) || Assert::maxLength($this->category, 20, "category in Item must have maxlength of 20 $within");
    }

    public function __construct()
    {
    }
}
