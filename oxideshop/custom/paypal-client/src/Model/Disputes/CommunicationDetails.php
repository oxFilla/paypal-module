<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Disputes;

/**
 * The contact details that a merchant provides to the customer to use to share their evidence documents.
 */
class CommunicationDetails
{
	/** @var string */
	public $email;

	/** @var string */
	public $note;

	/** @var string */
	public $time_posted;
}
