[{assign var="config" value=$oViewConf->getPayPalConfig()}]
[{if $config->isActive() && !$oViewConf->isPayPalSessionActive() && $config->showPayPalBasketButton()}]
    [{include file="paypal_smart_payment_buttons.tpl" buttonId="PayPalPayButtonNextCart2" buttonClass="float-right pull-right paypal-button-wrapper small" paymentStrategy="continue"}]
    <div class="float-right pull-right paypal-button-or">
        [{"OR"|oxmultilangassign|oxupper}]
    </div>
    [{if $loadingScreen == 'true'}]
        <div id="overlay"><div class="loader"></div></div>
        <script>
            document.getElementById("overlay").style.display = "block";
        </script>
    [{/if}]
[{/if}]
[{$smarty.block.parent}]
