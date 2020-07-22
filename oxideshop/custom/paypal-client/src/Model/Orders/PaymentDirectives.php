<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Orders;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;
use Webmozart\Assert\Assert;

/**
 * Payment Directives for transaction.
 *
 * generated from: model-payment_directives.json
 */
class PaymentDirectives implements JsonSerializable
{
    use BaseModel;

    /** Instant Disbursement Type. */
    const DISBURSEMENT_TYPE_INSTANT = 'INSTANT';

    /** Delayed Disbursement Type. */
    const DISBURSEMENT_TYPE_DELAYED = 'DELAYED';

    /** Full liability for post payment events. The loss_account will be used for events including refunds, reversals, disputes etc. */
    const LIABILITY_TYPE_FULL = 'FULL';

    /** Partial liability for post payment events. The loss_account will be used for limited cases like UNAUTH. */
    const LIABILITY_TYPE_PARTIAL = 'PARTIAL';

    /** Accept payment after auto currency conversion. */
    const CURRENCY_RECEIVING_DIRECTIVE_ACCEPT = 'ACCEPT';

    /** Deny payment. */
    const CURRENCY_RECEIVING_DIRECTIVE_DENY = 'DENY';

    /** Pend payment for seller's approval. */
    const CURRENCY_RECEIVING_DIRECTIVE_HOLD = 'HOLD';

    /** Accept payment after opening a new currency holding. */
    const CURRENCY_RECEIVING_DIRECTIVE_ACCEPT_OPEN = 'ACCEPT_OPEN';

    /**
     * @var string
     * Disbursement type.
     *
     * use one of constants defined in this class to set the value:
     * @see DISBURSEMENT_TYPE_INSTANT
     * @see DISBURSEMENT_TYPE_DELAYED
     * minLength: 1
     * maxLength: 255
     */
    public $disbursement_type;

    /**
     * @var string
     * Identifier that links the transactions to be treated as one atomic unit for payment processing. All-or-none
     * policy is enforced by this identifier.
     *
     * minLength: 1
     * maxLength: 10
     */
    public $linked_group_id;

    /**
     * @var string
     * Settlement account number where the funds finally get settled to.
     *
     * minLength: 1
     * maxLength: 30
     */
    public $settlement_account_number;

    /**
     * @var string
     * Loss account number used for recovery of loss.
     *
     * minLength: 1
     * maxLength: 30
     */
    public $loss_account_number;

    /**
     * @var string
     * Liability type defined by PayPal Risk.
     *
     * use one of constants defined in this class to set the value:
     * @see LIABILITY_TYPE_FULL
     * @see LIABILITY_TYPE_PARTIAL
     * minLength: 1
     * maxLength: 255
     */
    public $liability_type;

    /**
     * @var boolean
     * Special deny setting to force decline a (compliance) pending transaction.
     */
    public $special_deny;

    /**
     * @var boolean
     * A directive to allow or deny transactions with duplicate invoice id (for the receiver account).
     */
    public $allow_duplicate_invoice_id;

    /**
     * @var array<PolicyDirective>
     * Policy directives indicating how to process the payment.
     *
     * this is mandatory to be set
     * maxItems: 1
     * maxItems: 30
     */
    public $policy_directives;

    /**
     * @var array<PaymentMethodDirective>
     * Directives for certain payment methods based on eligibility.
     *
     * this is mandatory to be set
     * maxItems: 1
     * maxItems: 30
     */
    public $payment_method_directives;

    /**
     * @var array<PricingDirective>
     * Pricing directives for the transaction.
     *
     * this is mandatory to be set
     * maxItems: 1
     * maxItems: 25
     */
    public $pricing_directives;

    /**
     * @var AuthorizationDirectives
     * Auth directives for the transaction.
     */
    public $authorization_directives;

    /**
     * @var string
     * Currency receiving type defines the options when receiving payment in a currency not held by the reciver.
     *
     * use one of constants defined in this class to set the value:
     * @see CURRENCY_RECEIVING_DIRECTIVE_ACCEPT
     * @see CURRENCY_RECEIVING_DIRECTIVE_DENY
     * @see CURRENCY_RECEIVING_DIRECTIVE_HOLD
     * @see CURRENCY_RECEIVING_DIRECTIVE_ACCEPT_OPEN
     * minLength: 1
     * maxLength: 255
     */
    public $currency_receiving_directive;

    /**
     * @var boolean
     * Flag to indicate if immediate payment is required. A directive to fail the transaction if the payment goes to
     * a pending state.
     */
    public $immediate_payment_required;

    public function validate($from = null)
    {
        $within = isset($from) ? "within $from" : "";
        !isset($this->disbursement_type) || Assert::minLength($this->disbursement_type, 1, "disbursement_type in PaymentDirectives must have minlength of 1 $within");
        !isset($this->disbursement_type) || Assert::maxLength($this->disbursement_type, 255, "disbursement_type in PaymentDirectives must have maxlength of 255 $within");
        !isset($this->linked_group_id) || Assert::minLength($this->linked_group_id, 1, "linked_group_id in PaymentDirectives must have minlength of 1 $within");
        !isset($this->linked_group_id) || Assert::maxLength($this->linked_group_id, 10, "linked_group_id in PaymentDirectives must have maxlength of 10 $within");
        !isset($this->settlement_account_number) || Assert::minLength($this->settlement_account_number, 1, "settlement_account_number in PaymentDirectives must have minlength of 1 $within");
        !isset($this->settlement_account_number) || Assert::maxLength($this->settlement_account_number, 30, "settlement_account_number in PaymentDirectives must have maxlength of 30 $within");
        !isset($this->loss_account_number) || Assert::minLength($this->loss_account_number, 1, "loss_account_number in PaymentDirectives must have minlength of 1 $within");
        !isset($this->loss_account_number) || Assert::maxLength($this->loss_account_number, 30, "loss_account_number in PaymentDirectives must have maxlength of 30 $within");
        !isset($this->liability_type) || Assert::minLength($this->liability_type, 1, "liability_type in PaymentDirectives must have minlength of 1 $within");
        !isset($this->liability_type) || Assert::maxLength($this->liability_type, 255, "liability_type in PaymentDirectives must have maxlength of 255 $within");
        Assert::notNull($this->policy_directives, "policy_directives in PaymentDirectives must not be NULL $within");
         Assert::minCount($this->policy_directives, 1, "policy_directives in PaymentDirectives must have min. count of 1 $within");
         Assert::maxCount($this->policy_directives, 30, "policy_directives in PaymentDirectives must have max. count of 30 $within");
         Assert::isArray($this->policy_directives, "policy_directives in PaymentDirectives must be array $within");

                                if (isset($this->policy_directives)){
                                    foreach ($this->policy_directives as $item) {
                                        $item->validate(PaymentDirectives::class);
                                    }
                                }

        Assert::notNull($this->payment_method_directives, "payment_method_directives in PaymentDirectives must not be NULL $within");
         Assert::minCount($this->payment_method_directives, 1, "payment_method_directives in PaymentDirectives must have min. count of 1 $within");
         Assert::maxCount($this->payment_method_directives, 30, "payment_method_directives in PaymentDirectives must have max. count of 30 $within");
         Assert::isArray($this->payment_method_directives, "payment_method_directives in PaymentDirectives must be array $within");

                                if (isset($this->payment_method_directives)){
                                    foreach ($this->payment_method_directives as $item) {
                                        $item->validate(PaymentDirectives::class);
                                    }
                                }

        Assert::notNull($this->pricing_directives, "pricing_directives in PaymentDirectives must not be NULL $within");
         Assert::minCount($this->pricing_directives, 1, "pricing_directives in PaymentDirectives must have min. count of 1 $within");
         Assert::maxCount($this->pricing_directives, 25, "pricing_directives in PaymentDirectives must have max. count of 25 $within");
         Assert::isArray($this->pricing_directives, "pricing_directives in PaymentDirectives must be array $within");

                                if (isset($this->pricing_directives)){
                                    foreach ($this->pricing_directives as $item) {
                                        $item->validate(PaymentDirectives::class);
                                    }
                                }

        !isset($this->authorization_directives) || Assert::isInstanceOf($this->authorization_directives, AuthorizationDirectives::class, "authorization_directives in PaymentDirectives must be instance of AuthorizationDirectives $within");
        !isset($this->authorization_directives) || $this->authorization_directives->validate(PaymentDirectives::class);
        !isset($this->currency_receiving_directive) || Assert::minLength($this->currency_receiving_directive, 1, "currency_receiving_directive in PaymentDirectives must have minlength of 1 $within");
        !isset($this->currency_receiving_directive) || Assert::maxLength($this->currency_receiving_directive, 255, "currency_receiving_directive in PaymentDirectives must have maxlength of 255 $within");
    }

    public function __construct()
    {
    }
}
