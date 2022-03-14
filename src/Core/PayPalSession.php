<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidSolutionCatalysts\PayPal\Core;

use OxidEsales\Eshop\Core\Registry;

class PayPalSession
{
    /**
     * PayPal store checkoutOrderId
     *
     * @param $checkoutOrderId
     */
    public static function storePayPalOrderId(string $checkoutOrderId): void
    {
        Registry::getSession()->setVariable(
            Constants::SESSION_CHECKOUT_ORDER_ID,
            $checkoutOrderId
        );
    }

    /**
     * PayPal remove checkoutOrderId
     */
    public static function unsetPayPalOrderId()
    {
        Registry::getSession()->deleteVariable(
            Constants::SESSION_CHECKOUT_ORDER_ID
        );
    }

    /**
     * Checks if active PayPal Order exists
     *
     * @return bool
     */
    public static function isPayPalExpressOrderActive(): bool
    {
        if (!self::getCheckoutOrderId()) {
            return false;
        }

        $paymentId = Registry::getSession()->getBasket()->getPaymentId();
        if (PayPalDefinitions::EXPRESS_PAYPAL_PAYMENT_ID !== $paymentId) {
            return false;
        }

        return true;
    }

    /**
     * PayPal checkout order id getter
     *
     * @return mixed
     */
    public static function getCheckoutOrderId()
    {
        return Registry::getSession()->getVariable(Constants::SESSION_CHECKOUT_ORDER_ID);
    }

    public static function subscriptionIsProcessing(): void
    {
        Registry::getSession()->setVariable('SessionIsProcessing', true);
    }

    public static function subscriptionIsDoneProcessing(): void
    {
        $session = Registry::getSession();
        $session->deleteVariable('SessionIsProcessing');
        $session->deleteVariable('subscriptionProductOrderId');
    }

    public static function isSubscriptionProcessing(): bool
    {
        $isSubscriptionProcessing = Registry::getSession()->getVariable('SessionIsProcessing');
        return empty($isSubscriptionProcessing) ? false : true;
    }

    public static function setSessionRedirectLink(string $link): void
    {
        Registry::getSession()->setVariable(
            Constants::SESSION_REDIRECTLINK,
            $link
        );
    }

    public static function getSessionRedirectLink(): string
    {
        return (string) Registry::getSession()->getVariable(
            Constants::SESSION_REDIRECTLINK
        );
    }

    public static function unsetSessionRedirectLink():void
    {
        Registry::getSession()->deleteVariable(
            Constants::SESSION_REDIRECTLINK
        );
    }

    public static function storeMerchantIdInPayPal(string $merchantId): void
    {
        Registry::getSession()->setVariable(
            Constants::SESSION_ONBOARDING_MERCHANTIDINPAYPAL,
            $merchantId
        );
    }

    public static function getMerchantIdInPayPal(): ?string
    {
        return Registry::getSession()->getVariable(
            Constants::SESSION_ONBOARDING_MERCHANTIDINPAYPAL
        );
    }

    public static function storeOnboardingPayload(string $payload): void
    {
        Registry::getSession()->setVariable(
            Constants::SESSION_ONBOARDING_PAYLOAD,
            $payload
        );
    }

    public static function getOnboardingPayload(): ?string
    {
        return Registry::getSession()->getVariable(
            Constants::SESSION_ONBOARDING_PAYLOAD
        );
    }

    public static function unsetOnboardingSession(): void
    {
        Registry::getSession()->deleteVariable(
            Constants::SESSION_ONBOARDING_MERCHANTID
        );
        Registry::getSession()->deleteVariable(
            Constants::SESSION_ONBOARDING_MERCHANTIDINPAYPAL
        );
        Registry::getSession()->deleteVariable(
            Constants::SESSION_ONBOARDING_PAYLOAD
        );
    }
}
