<?php

namespace OxidProfessionalServices\PayPal\Api\Model\Orders;

use JsonSerializable;
use OxidProfessionalServices\PayPal\Api\Model\BaseModel;
use OxidProfessionalServices\PayPal\Api\Model\CommonV4\Phone;
use Webmozart\Assert\Assert;

/**
 * Phone information.
 *
 * generated from: model-phone_info.json
 */
class PhoneInfo implements JsonSerializable
{
    use BaseModel;

    /** A fax machine. */
    public const PHONE_TYPE_FAX = 'FAX';

    /** A home phone. */
    public const PHONE_TYPE_HOME = 'HOME';

    /** A mobile phone. */
    public const PHONE_TYPE_MOBILE = 'MOBILE';

    /** Other. */
    public const PHONE_TYPE_OTHER = 'OTHER';

    /** A pager. */
    public const PHONE_TYPE_PAGER = 'PAGER';

    /** A work phone. */
    public const PHONE_TYPE_WORK = 'WORK';

    /**
     * The phone number in its canonical international [E.164 numbering plan
     * format](https://www.itu.int/rec/T-REC-E.164/en).
     *
     * @var Phone | null
     */
    public $phone_number;

    /**
     * The phone type.
     *
     * use one of constants defined in this class to set the value:
     * @see PHONE_TYPE_FAX
     * @see PHONE_TYPE_HOME
     * @see PHONE_TYPE_MOBILE
     * @see PHONE_TYPE_OTHER
     * @see PHONE_TYPE_PAGER
     * @see PHONE_TYPE_WORK
     * @var string | null
     */
    public $phone_type;

    public function validate($from = null)
    {
        $within = isset($from) ? "within $from" : "";
        !isset($this->phone_number) || Assert::isInstanceOf(
            $this->phone_number,
            Phone::class,
            "phone_number in PhoneInfo must be instance of Phone $within"
        );
        !isset($this->phone_number) ||  $this->phone_number->validate(PhoneInfo::class);
    }

    private function map(array $data)
    {
        if (isset($data['phone_number'])) {
            $this->phone_number = new Phone($data['phone_number']);
        }
        if (isset($data['phone_type'])) {
            $this->phone_type = $data['phone_type'];
        }
    }

    public function __construct(array $data = null)
    {
        if (isset($data)) { $this->map($data); }
    }
}
