<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Payments;

/**
 * The breakdown of the amount. Breakdown provides details such as total item amount, total tax amount, shipping, handling, insurance, and discounts, if any.
 */
class AmountBreakdown
{
	/** @var Money */
	public $item_total;

	/** @var Money */
	public $shipping;

	/** @var Money */
	public $handling;

	/** @var Money */
	public $tax_total;

	/** @var Money */
	public $insurance;

	/** @var Money */
	public $shipping_discount;

	/** @var Money */
	public $discount;
}
