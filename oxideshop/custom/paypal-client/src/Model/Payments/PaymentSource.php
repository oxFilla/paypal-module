<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Payments;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;
use Webmozart\Assert\Assert;

/**
 * The payment source definition.
 *
 * generated from: MerchantCommonComponentsSpecification-v1-schema-payment_source.json
 */
class PaymentSource implements JsonSerializable
{
    use BaseModel;

    /**
     * @var Card
     * The payment card to use to fund a payment. Can be a credit or debit card.
     */
    public $card;

    /**
     * @var Token
     * The tokenized payment source to fund a payment.
     */
    public $token;

    /**
     * @var Bank
     * The bank source used to fund the payment
     */
    public $bank;

    /**
     * @var PaypalWallet
     * A resource that identies that a paypal wallet is used for payment.
     */
    public $paypal;

    /**
     * @var AlipayRequest
     * Information needed to pay using Alipay
     */
    public $alipay;

    /**
     * @var BancontactRequest
     * Information needed to pay using Bancontact.
     */
    public $bancontact;

    /**
     * @var BlikRequest
     * Information needed to pay using BLIK.
     */
    public $blik;

    /**
     * @var EpsRequest
     * Information needed to pay using eps.
     */
    public $eps;

    /**
     * @var GiropayRequest
     * Information needed to pay using giropay.
     */
    public $giropay;

    /**
     * @var IdealRequest
     * Information needed to pay using iDEAL.
     */
    public $ideal;

    /**
     * @var MultibancoRequest
     * Information needed to pay using Multibanco.
     */
    public $multibanco;

    /**
     * @var MybankRequest
     * Information needed to pay using MyBank.
     */
    public $mybank;

    /**
     * @var PayuRequest
     * Information needed to pay using PayU.
     */
    public $payu;

    /**
     * @var PTwoFourRequest
     * Information needed to pay using P24 (Przelewy24).
     */
    public $p24;

    /**
     * @var PoliRequest
     * Information needed to pay using POLi.
     */
    public $poli;

    /**
     * @var SofortRequest
     * Information needed to pay using Sofort.
     */
    public $sofort;

    /**
     * @var TrustlyRequest
     * Information needed to pay using Trustly.
     */
    public $trustly;

    /**
     * @var TrustpayRequest
     * Information needed to pay using TrustPay.
     */
    public $trustpay;

    /**
     * @var VerkkopankkiRequest
     * Information needed to pay using Verkkopankki (Finnish Online Banking).
     */
    public $verkkopankki;

    /**
     * @var WechatpayRequest
     * Information needed to pay using WeChat Pay.
     */
    public $wechatpay;

    public function validate($from = null)
    {
        $within = isset($from) ? "within $from" : "";
        !isset($this->card) || Assert::isInstanceOf($this->card, Card::class, "card in PaymentSource must be instance of Card $within");
        !isset($this->card) || $this->card->validate(PaymentSource::class);
        !isset($this->token) || Assert::isInstanceOf($this->token, Token::class, "token in PaymentSource must be instance of Token $within");
        !isset($this->token) || $this->token->validate(PaymentSource::class);
        !isset($this->bank) || Assert::isInstanceOf($this->bank, Bank::class, "bank in PaymentSource must be instance of Bank $within");
        !isset($this->bank) || $this->bank->validate(PaymentSource::class);
        !isset($this->paypal) || Assert::isInstanceOf($this->paypal, PaypalWallet::class, "paypal in PaymentSource must be instance of PaypalWallet $within");
        !isset($this->paypal) || $this->paypal->validate(PaymentSource::class);
        !isset($this->alipay) || Assert::isInstanceOf($this->alipay, AlipayRequest::class, "alipay in PaymentSource must be instance of AlipayRequest $within");
        !isset($this->alipay) || $this->alipay->validate(PaymentSource::class);
        !isset($this->bancontact) || Assert::isInstanceOf($this->bancontact, BancontactRequest::class, "bancontact in PaymentSource must be instance of BancontactRequest $within");
        !isset($this->bancontact) || $this->bancontact->validate(PaymentSource::class);
        !isset($this->blik) || Assert::isInstanceOf($this->blik, BlikRequest::class, "blik in PaymentSource must be instance of BlikRequest $within");
        !isset($this->blik) || $this->blik->validate(PaymentSource::class);
        !isset($this->eps) || Assert::isInstanceOf($this->eps, EpsRequest::class, "eps in PaymentSource must be instance of EpsRequest $within");
        !isset($this->eps) || $this->eps->validate(PaymentSource::class);
        !isset($this->giropay) || Assert::isInstanceOf($this->giropay, GiropayRequest::class, "giropay in PaymentSource must be instance of GiropayRequest $within");
        !isset($this->giropay) || $this->giropay->validate(PaymentSource::class);
        !isset($this->ideal) || Assert::isInstanceOf($this->ideal, IdealRequest::class, "ideal in PaymentSource must be instance of IdealRequest $within");
        !isset($this->ideal) || $this->ideal->validate(PaymentSource::class);
        !isset($this->multibanco) || Assert::isInstanceOf($this->multibanco, MultibancoRequest::class, "multibanco in PaymentSource must be instance of MultibancoRequest $within");
        !isset($this->multibanco) || $this->multibanco->validate(PaymentSource::class);
        !isset($this->mybank) || Assert::isInstanceOf($this->mybank, MybankRequest::class, "mybank in PaymentSource must be instance of MybankRequest $within");
        !isset($this->mybank) || $this->mybank->validate(PaymentSource::class);
        !isset($this->payu) || Assert::isInstanceOf($this->payu, PayuRequest::class, "payu in PaymentSource must be instance of PayuRequest $within");
        !isset($this->payu) || $this->payu->validate(PaymentSource::class);
        !isset($this->p24) || Assert::isInstanceOf($this->p24, PTwoFourRequest::class, "p24 in PaymentSource must be instance of PTwoFourRequest $within");
        !isset($this->p24) || $this->p24->validate(PaymentSource::class);
        !isset($this->poli) || Assert::isInstanceOf($this->poli, PoliRequest::class, "poli in PaymentSource must be instance of PoliRequest $within");
        !isset($this->poli) || $this->poli->validate(PaymentSource::class);
        !isset($this->sofort) || Assert::isInstanceOf($this->sofort, SofortRequest::class, "sofort in PaymentSource must be instance of SofortRequest $within");
        !isset($this->sofort) || $this->sofort->validate(PaymentSource::class);
        !isset($this->trustly) || Assert::isInstanceOf($this->trustly, TrustlyRequest::class, "trustly in PaymentSource must be instance of TrustlyRequest $within");
        !isset($this->trustly) || $this->trustly->validate(PaymentSource::class);
        !isset($this->trustpay) || Assert::isInstanceOf($this->trustpay, TrustpayRequest::class, "trustpay in PaymentSource must be instance of TrustpayRequest $within");
        !isset($this->trustpay) || $this->trustpay->validate(PaymentSource::class);
        !isset($this->verkkopankki) || Assert::isInstanceOf($this->verkkopankki, VerkkopankkiRequest::class, "verkkopankki in PaymentSource must be instance of VerkkopankkiRequest $within");
        !isset($this->verkkopankki) || $this->verkkopankki->validate(PaymentSource::class);
        !isset($this->wechatpay) || Assert::isInstanceOf($this->wechatpay, WechatpayRequest::class, "wechatpay in PaymentSource must be instance of WechatpayRequest $within");
        !isset($this->wechatpay) || $this->wechatpay->validate(PaymentSource::class);
    }

    public function __construct()
    {
    }
}
