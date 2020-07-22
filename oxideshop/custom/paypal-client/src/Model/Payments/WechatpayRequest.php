<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Payments;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;
use Webmozart\Assert\Assert;

/**
 * Information needed to pay using WeChat Pay.
 *
 * generated from: MerchantCommonComponentsSpecification-v1-schema-wechatpay_request.json
 */
class WechatpayRequest implements JsonSerializable
{
    use BaseModel;

    /**
     * @var string
     * The full name representation like Mr J Smith
     *
     * this is mandatory to be set
     * minLength: 3
     * maxLength: 300
     */
    public $name;

    /**
     * @var string
     * The [two-character ISO 3166-1 code](/docs/integration/direct/rest/country-codes/) that identifies the country
     * or region.<blockquote><strong>Note:</strong> The country code for Great Britain is <code>GB</code> and not
     * <code>UK</code> as used in the top-level domain names for that country. Use the `C2` country code for China
     * worldwide for comparable uncontrolled price (CUP) method, bank card, and cross-border
     * transactions.</blockquote>
     *
     * this is mandatory to be set
     * minLength: 2
     * maxLength: 2
     */
    public $country_code;

    public function validate($from = null)
    {
        $within = isset($from) ? "within $from" : "";
        Assert::notNull($this->name, "name in WechatpayRequest must not be NULL $within");
         Assert::minLength($this->name, 3, "name in WechatpayRequest must have minlength of 3 $within");
         Assert::maxLength($this->name, 300, "name in WechatpayRequest must have maxlength of 300 $within");
        Assert::notNull($this->country_code, "country_code in WechatpayRequest must not be NULL $within");
         Assert::minLength($this->country_code, 2, "country_code in WechatpayRequest must have minlength of 2 $within");
         Assert::maxLength($this->country_code, 2, "country_code in WechatpayRequest must have maxlength of 2 $within");
    }

    public function __construct()
    {
    }
}
