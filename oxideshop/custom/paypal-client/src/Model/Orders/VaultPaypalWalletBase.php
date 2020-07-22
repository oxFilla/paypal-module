<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Orders;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;
use Webmozart\Assert\Assert;

/**
 * Resource consolidating common request and response attirbutes for vaulting PayPal Wallet.
 *
 * generated from: MerchantsCommonComponentsSpecification-v1-schema-vault_paypal_wallet_base.json
 */
class VaultPaypalWalletBase implements JsonSerializable
{
    use BaseModel;

    /** The PayPal Payment Token will be used for future transaction directly with a merchant. */
    const USAGE_TYPE_MERCHANT = 'MERCHANT';

    /** The PayPal Payment Token will be used for future transaction on a platform. A platform is typically a marketplace or a channel that a payer can purchase goods and services from multiple merchants. */
    const USAGE_TYPE_PLATFORM = 'PLATFORM';

    /** The customer vaulting the PayPal payment token is a consumer on the merchant / platform. */
    const CUSTOMER_TYPE_CONSUMER = 'CONSUMER';

    /** The customer vaulting the PayPal payment token is a business on merchant / platform. */
    const CUSTOMER_TYPE_BUSINESS = 'BUSINESS';

    /**
     * @var string
     * The description displayed to PayPal consumer on the approval flow for PayPal, as well as on the PayPal payment
     * token management experience on PayPal.com.
     *
     * minLength: 1
     * maxLength: 128
     */
    public $description;

    /**
     * @var string
     * Merchant/Partner defined identifier uniquely identify merchant/partner's business and the usage of the PayPal
     * payment token for the business. Please contact your PayPal Technical Account Manager to define the
     * product_label for your business and how it can help your business. For details on “product_label” and
     * different types of usages of a PayPal Payment Token, please refer to documentation. For a business with
     * different type of usage of the payment method, a new product_label needs to be defined and a new PayPal
     * Payment Token will be created. For including multiple businesses of same charge pattern, an existing
     * product_label with the same charge pattern can be leveraged. Business can decide to use custom name for the
     * product_label. If no product_label is specified, default policies will apply for PayPal payment method,
     * irrespective of the nature of the business.
     *
     * minLength: 1
     * maxLength: 25
     */
    public $product_label;

    /**
     * @var ShippingDetail
     * The shipping details.
     */
    public $shipping;

    /**
     * @var string
     * The usage type associated with the PayPal payment token.
     *
     * use one of constants defined in this class to set the value:
     * @see USAGE_TYPE_MERCHANT
     * @see USAGE_TYPE_PLATFORM
     * this is mandatory to be set
     * minLength: 1
     * maxLength: 255
     */
    public $usage_type;

    /**
     * @var string
     * The customer type associated with the PayPal payment token. This is to indicate whether the customer acting on
     * the merchant / platform is either a business or a consumer.
     *
     * use one of constants defined in this class to set the value:
     * @see CUSTOMER_TYPE_CONSUMER
     * @see CUSTOMER_TYPE_BUSINESS
     * minLength: 1
     * maxLength: 255
     */
    public $customer_type = 'CONSUMER';

    /**
     * @var boolean
     * Create multiple payment tokens for the same payer, merchant/platform combination. Use this when the customer
     * has not logged in at merchant/platform. The payment token thus generated, can then also be used to create the
     * customer account at merchant/platform. Use this also when multiple payment tokens are required for the same
     * payer, different customer at merchant/platform. This helps to identify customers distinctly even though they
     * may share the same PayPal account. This only applies to PayPal payment source.
     */
    public $permit_multiple_payment_tokens = false;

    public function validate($from = null)
    {
        $within = isset($from) ? "within $from" : "";
        !isset($this->description) || Assert::minLength($this->description, 1, "description in VaultPaypalWalletBase must have minlength of 1 $within");
        !isset($this->description) || Assert::maxLength($this->description, 128, "description in VaultPaypalWalletBase must have maxlength of 128 $within");
        !isset($this->product_label) || Assert::minLength($this->product_label, 1, "product_label in VaultPaypalWalletBase must have minlength of 1 $within");
        !isset($this->product_label) || Assert::maxLength($this->product_label, 25, "product_label in VaultPaypalWalletBase must have maxlength of 25 $within");
        !isset($this->shipping) || Assert::isInstanceOf($this->shipping, ShippingDetail::class, "shipping in VaultPaypalWalletBase must be instance of ShippingDetail $within");
        !isset($this->shipping) || $this->shipping->validate(VaultPaypalWalletBase::class);
        Assert::notNull($this->usage_type, "usage_type in VaultPaypalWalletBase must not be NULL $within");
         Assert::minLength($this->usage_type, 1, "usage_type in VaultPaypalWalletBase must have minlength of 1 $within");
         Assert::maxLength($this->usage_type, 255, "usage_type in VaultPaypalWalletBase must have maxlength of 255 $within");
        !isset($this->customer_type) || Assert::minLength($this->customer_type, 1, "customer_type in VaultPaypalWalletBase must have minlength of 1 $within");
        !isset($this->customer_type) || Assert::maxLength($this->customer_type, 255, "customer_type in VaultPaypalWalletBase must have maxlength of 255 $within");
    }

    public function __construct()
    {
    }
}
