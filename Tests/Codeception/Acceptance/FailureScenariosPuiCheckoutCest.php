<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidSolutionCatalysts\PayPal\Tests\Codeception\Acceptance;

use OxidSolutionCatalysts\PayPal\Core\PayPalDefinitions;
use OxidSolutionCatalysts\PayPal\Tests\Codeception\AcceptanceTester;
use Codeception\Util\Fixtures;
use Codeception\Example;
use OxidEsales\Codeception\Page\Checkout\ThankYou;
use OxidEsales\Codeception\Page\Checkout\PaymentCheckout;
use OxidEsales\Codeception\Page\Checkout\OrderCheckout;
use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * @group osc_paypal
 * @group osc_paypal_checkout
 * @group osc_paypal_checkout_pui
 * @group osc_paypal_checkout_pui_failscenario
 */
final class FailureScenariosPuiCheckoutCest extends BaseCest
{
    public function _after(AcceptanceTester $I): void
    {
        $I->updateInDatabase(
            'oxuser',
            [
                'oxfon' => '040111222333',
                'oxbirthdate' => '2000-04-01',
                'oxusername' => Fixtures::get('userName')
            ],
            [
                'oxid' => Fixtures::get('userId')
            ]
        );

        $I->wait(5); //TODO: check in which cases we hit the sandbox rate limit

        parent::_after($I);
    }


    protected function providerPUIFailure(): array
    {
        return [
            [
                'mail' => 'payment_source_info_cannot_be_verified@example.com',
                'reason' => 'PAYMENT_SOURCE_INFO_CANNOT_BE_VERIFIED',
                'expected' => 'PUI_PAYMENT_SOURCE_INFO_CANNOT_BE_VERIFIED'
            ],
            [
                'mail' => 'payment_source_declined_by_processor@example.com',
                'reason' => 'PAYMENT_SOURCE_DECLINED_BY_PROCESSOR',
                'expected' => 'PUI_PAYMENT_SOURCE_DECLINED_BY_PROCESSOR'
            ],
            [
                'mail' => 'payment_source_cannot_be_used@example.com',
                'reason' => 'PAYMENT_SOURCE_CANNOT_BE_USED',
                'expected' => 'PAYPAL_PAYMENT_ERROR_PUI_GENRIC'
            ],
            [
                'mail' => 'billing_address_invalid@example.com',
                'reason' => 'BILLING_ADDRESS_INVALID',
                'expected' => 'PAYPAL_PAYMENT_ERROR_PUI_GENRIC'
            ],
            [
                'mail' => 'shipping_address_invalid@example.com',
                'reason' => 'SHIPPING_ADDRESS_INVALID',
                'expected' => 'PAYPAL_PAYMENT_ERROR_PUI_GENRIC'
            ],
        ];
    }

    /**
     * @dataProvider providerPUIFailure
     */
    public function checkoutWithPUIViaPayPalFailureScenarios(AcceptanceTester $I, Example $data): void
    {
        $I->wantToTest('PUI failure scenarios');

        //mail address triggers predefined failure response in PayPal system
        $userName = $data['mail'];

        $I->seeNumRecords(0, 'oscpaypal_order');
        $I->seeNumRecords(1, 'oxorder');

        $I->updateInDatabase(
            'oxuser',
            [
                'oxusername' => $userName
            ],
            [
                'oxid' => Fixtures::get('userId')
            ]
        );

        $this->proceedToPaymentStep($I, $userName);

        $paymentCheckout = new PaymentCheckout($I);
        /** @var OrderCheckout $orderCheckout */
        $orderCheckout = $paymentCheckout->selectPayment('oscpaypal_pui')
            ->goToNextStep();
        $I->executeJS('document.getElementsByName("pui_required[phonenumber]")[0].value = "040111222333";');
        $orderCheckout->submitOrder();
        $I->waitForPageLoad();

        $I->see(Translator::translate('PAYMENT_METHOD'));
        $I->see(substr(Translator::translate($data['expected']), 0, 30));

        //no change in database
        $I->seeNumRecords(0, 'oscpaypal_order');
        $I->seeNumRecords(1, 'oxorder');
    }

}
