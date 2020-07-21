<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Payments;

/**
 * Any additional payment instructions for PayPal Commerce Platform customers. Enables features for the PayPal Commerce Platform, such as delayed disbursement and collection of a platform fee. Applies during order creation for captured payments or during capture of authorized payments.
 */
class PaymentInstruction
{
	/** @var array */
	public $platform_fees;

	/** @var string */
	public $disbursement_mode;
}
