[{assign var="config" value=$oViewConf->getPayPalConfig()}]
[{if $config->isActive() && !$oViewConf->isPayPalExpressSessionActive() && $config->showPayPalProductDetailsButton()}]
    [{include file="oscpaypalsmartpaymentbuttons.tpl" buttonId="PayPalButtonProductMain" buttonClass="paypal-button-wrapper large" aid=$oDetailsProduct->oxarticles__oxid->value}]
[{/if}]
