<?php

namespace OxidProfessionalServices\PayPal\Api\Orders;

/**
 * The airline itinerary details.
 */
class AirlineItinerary
{
	/** @var array */
	public $flight_leg_details;

	/** @var integer */
	public $clearing_sequence;

	/** @var integer */
	public $clearing_count;
}
