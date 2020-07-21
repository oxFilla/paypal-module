<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Subscriptions;

/**
 * The options that the payee or merchant offers to the payer to ship or pick up their items.
 */
class ShippingOption
{
	/** @var string */
	public $id;

	/** @var string */
	public $label;

	/** @var string */
	public $type;

	/** @var Money */
	public $amount;

	/** @var boolean */
	public $selected;
}
