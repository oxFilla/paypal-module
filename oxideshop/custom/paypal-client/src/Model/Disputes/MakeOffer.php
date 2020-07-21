<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Disputes;

/**
 * A merchant request to make an offer to resolve a dispute.
 */
class MakeOffer
{
	/** @var string */
	public $note;

	/** @var Money */
	public $offer_amount;

	/** @var AddressPortable */
	public $return_shipping_address;

	/** @var string */
	public $invoice_id;

	/** @var string */
	public $offer_type;
}
