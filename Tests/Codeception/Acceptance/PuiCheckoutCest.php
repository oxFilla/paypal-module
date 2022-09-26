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
 * @group osc_paypal_checkout_pui_generic
 */
final class PuiCheckoutCest extends BaseCest
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

    /**
     * @group osc_paypal_checkout_pui_success
     */
    public function checkoutWithPUIViaPayPalSuccessEnterMandatoryFields(AcceptanceTester $I): void
    {
        $I->wantToTest('logged in user with PUI via PayPal successfully places an order.');

        $I->seeNumRecords(0, 'oscpaypal_order');
        $I->seeNumRecords(1, 'oxorder');

        $I->updateInDatabase(
            'oxuser',
            [
                'oxfon' => '',
            ],
            [
                'oxid' => Fixtures::get('userId')
            ]
        );

        $this->proceedToPaymentStep($I, Fixtures::get('userName'));

        $paymentCheckout = new PaymentCheckout($I);
        /** @var OrderCheckout $orderCheckout */
        $orderCheckout = $paymentCheckout->selectPayment('oscpaypal_pui')
            ->goToNextStep();

        $I->executeJS('document.getElementsByName("pui_required[phonenumber]")[0].value = "040111222333";');
        $I->executeJS('document.getElementsByName("pui_required[birthdate][year]")[0].value = "2000";');
        $I->executeJS('document.getElementsByName("pui_required[birthdate][month]")[0].value = "4";');
        $I->executeJS('document.getElementsByName("pui_required[birthdate][day]")[0].value = "1";');

        $orderCheckout->submitOrder();
        $I->waitForPageLoad();

        $thankYouPage = new ThankYou($I);
        $orderNumber = $thankYouPage->grabOrderNumber();
        $I->assertGreaterThan(1, $orderNumber);

        $orderId = $I->grabFromDatabase('oxorder', 'oxid', ['OXORDERNR' => $orderNumber]);
        $I->seeInDataBase(
            'oscpaypal_order',
            [
                'OXORDERID' => $orderId
            ]
        );

        $I->seeInDataBase(
            'oxorder',
            [
                'OXID' => $orderId,
                'OXTOTALORDERSUM' => '119.6',
                'OXBILLFNAME' => Fixtures::get('details')['firstname']
            ]
        );

        //PayPal needs a little time to process the transaction
        $I->wait(30);

        //As we have a PayPal order now, also check admin
        $this->openOrderPayPal($I, (string) $orderNumber);
        $I->wait(1);
        $I->see(Translator::translate('OSC_PAYPAL_HISTORY_PAYPAL_STATUS'));
        $I->see(Translator::translate('OSC_PAYPAL_STATUS_COMPLETED'));
        $I->seeElement('//input[@id="refundAmount"]');
        $I->see('119,60 EUR');

        //NOTE: we have no available webhook end point during this test, so order will not yet be marked as paid
        //$oxPaid = $I->grabFromDatabase('oxorder', 'oxpaid', ['OXID' => $orderId]);
    }

    /**
     * @group osc_paypal_checkout_pui_success
     */
    public function checkoutWithPUIViaPayPalSuccess(AcceptanceTester $I): void
    {
        $I->wantToTest('logged in user with PUI via PayPal successfully places an order.');

        $I->seeNumRecords(0, 'oscpaypal_order');
        $I->seeNumRecords(1, 'oxorder');

        $I->updateInDatabase(
            'oxuser',
            [
                'oxfon' => '040111222333',
                'oxbirthdate' => '2000-04-01'
            ],
            [
                'oxusername' => Fixtures::get('userName')
            ]
        );

        $this->proceedToPaymentStep($I, Fixtures::get('userName'));

        $paymentCheckout = new PaymentCheckout($I);
        /** @var OrderCheckout $orderCheckout */
        $orderCheckout = $paymentCheckout->selectPayment('oscpaypal_pui')
            ->goToNextStep();
        $orderCheckout->submitOrder();
        $I->waitForPageLoad();

        $thankYouPage = new ThankYou($I);
        $orderNumber = $thankYouPage->grabOrderNumber();
        $I->assertGreaterThan(1, $orderNumber);

        $orderId = $I->grabFromDatabase('oxorder', 'oxid', ['OXORDERNR' => $orderNumber]);
        $I->seeInDataBase(
            'oscpaypal_order',
            [
                'OXORDERID' => $orderId
            ]
        );

        $I->seeInDataBase(
            'oxorder',
            [
                'OXID' => $orderId,
                'OXTOTALORDERSUM' => '119.6',
                'OXBILLFNAME' => Fixtures::get('details')['firstname']
            ]
        );

        //PayPal needs a little time to process the transaction
        $I->wait(30);

        //As we have a PayPal order now, also check admin
        $this->openOrderPayPal($I, (string) $orderNumber);
        $I->wait(1);
        $I->see(Translator::translate('OSC_PAYPAL_HISTORY_PAYPAL_STATUS'));
        $I->see(Translator::translate('OSC_PAYPAL_STATUS_COMPLETED'));
        $I->seeElement('//input[@id="refundAmount"]');
        $I->see('119,60 EUR');

        //NOTE: if we have no available webhook end point during this test, order will not yet be marked as paid
        //$oxPaid = $I->grabFromDatabase('oxorder', 'oxpaid', ['OXID' => $orderId]);
    }

    public function checkoutWithPuiViaPayPalMissingRequiredFields(AcceptanceTester $I): void
    {
        $I->wantToTest('logged in user with PUI via PayPal cannot place order without mandatory fields');

        $I->seeNumRecords(0, 'oscpaypal_order');
        $I->seeNumRecords(1, 'oxorder');

        $I->updateInDatabase(
            'oxuser',
            [
                'oxfon' => ''
            ],
            [
                'oxid' => Fixtures::get('userId')
            ]
        );

        $this->proceedToPaymentStep($I, Fixtures::get('userName'));

        $paymentCheckout = new PaymentCheckout($I);
        /** @var OrderCheckout $orderCheckout */
        $orderCheckout = $paymentCheckout->selectPayment('oscpaypal_pui')
            ->goToNextStep();
        $orderCheckout->submitOrder();

        $I->waitForPageLoad();
        $I->seeElement("#orderConfirmAgbBottom");

        //nothing changed
        $I->seeNumRecords(0, 'oscpaypal_order');
        $I->seeNumRecords(1, 'oxorder');
    }

    public function checkoutWithPuiViaPayPalError(AcceptanceTester $I): void
    {
        $I->wantToTest('logged in user with PUI via PayPal runs into payment error (unparsable phone).');

        $I->seeNumRecords(0, 'oscpaypal_order');
        $I->seeNumRecords(1, 'oxorder');

        $I->updateInDatabase(
            'oxuser',
            [
                'oxfon' => 'lalalala',
                'oxbirthdate' => '2000-04-01'
            ],
            [
                'oxusername' => Fixtures::get('userName')
            ]
        );

        $this->proceedToPaymentStep($I, Fixtures::get('userName'));

        $paymentCheckout = new PaymentCheckout($I);
        /** @var OrderCheckout $orderCheckout */
        $orderCheckout = $paymentCheckout->selectPayment('oscpaypal_pui')
            ->goToNextStep();
        $orderCheckout->submitOrder();

        $I->waitForPageLoad();
        $I->see(Translator::translate('OSC_PAYPAL_PUI_PLEASE_RETRY'));

        //nothing changed
        $I->seeNumRecords(0, 'oscpaypal_order');
        $I->seeNumRecords(1, 'oxorder');

        //retry with valid phone
        $I->executeJS('document.getElementsByName("pui_required[phonenumber]")[0].value = "040111222333";');
        $orderCheckout->submitOrder();

        $thankYouPage = new ThankYou($I);
        $orderNumber = $thankYouPage->grabOrderNumber();
        $I->assertGreaterThan(1, $orderNumber);

        //got an order
        $I->seeNumRecords(1, 'oscpaypal_order');
        $I->seeNumRecords(2, 'oxorder');
    }

    /**
     * @dataProvider providerStock
     *
     * @group oscpaypal_stock
     */
    public function checkoutLastItemInStockWithPUIViaPayPal(AcceptanceTester $I, Example $data): void
    {
        $I->wantToTest(
            'logged in user with pui via PayPal successfully places an order for last available items.'
        );

        $this->setProductAvailability($I, $data['stockflag'], Fixtures::get('product')['amount']);

        $I->updateInDatabase(
            'oxuser',
            [
                'oxfon' => '040111222333',
                'oxbirthdate' => '2000-04-01'
            ],
            [
                'oxusername' => Fixtures::get('userName')
            ]
        );

        $this->proceedToPaymentStep($I, Fixtures::get('userName'));

        $paymentCheckout = new PaymentCheckout($I);
        /** @var OrderCheckout $orderCheckout */
        $paymentCheckout->selectPayment(PayPalDefinitions::PUI_PAYPAL_PAYMENT_ID)
            ->goToNextStep()
            ->submitOrder();
        $I->waitForPageLoad();

        $thankYouPage = new ThankYou($I);
        $orderNumber = $thankYouPage->grabOrderNumber();
        $I->assertGreaterThan(1, $orderNumber);

        $orderId = $I->grabFromDatabase('oxorder', 'oxid', ['OXORDERNR' => $orderNumber]);
        $I->seeInDataBase(
            'oscpaypal_order',
            [
                'OXORDERID' => $orderId
            ]
        );

        $I->seeInDataBase(
            'oxorder',
            [
                'OXID' => $orderId,
                'OXTOTALORDERSUM' => '119.6',
                'OXBILLFNAME' => Fixtures::get('details')['firstname']
            ]
        );
    }
}
