[{$smarty.block.parent}]
[{if $oViewConf->isModuleActive('osc_paypal') && $oViewConf->showPayPalBannerOnCategoryPage()}]
    [{assign var="paypalInstallmentPrice" value=$oxcmp_basket->getBruttoSum()}]
    [{if $oxcmp_basket->isPriceViewModeNetto()}]
        [{assign var="paypalInstallmentPrice" value=$oxcmp_basket->getNettoSum()}]
    [{/if}]

    [{oxstyle include=$oViewConf->getModuleUrl('osc_paypal','out/src/css/paypal_installment.css')}]
    [{include file="tpl/installment_banners.tpl" amount=$paypalInstallmentPrice selector=$oViewConf->getPayPalBannerCategoryPageSelector()}]
[{/if}]
