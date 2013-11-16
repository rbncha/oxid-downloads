[{if $oView->getCrossSelling()|count}]
    [{capture append="oxidBlock_productbar"}]
        [{include file="widget/product/boxproducts.tpl" _boxId="cross" _oBoxProducts=$oView->getCrossSelling() _sHeaderIdent="WIDGET_PRODUCT_RELATED_PRODUCTS_CROSSSELING_HEADER" _sHeaderCssClass="lightHead"}]
    [{/capture}]
[{/if}]

[{ if $oView->getSimilarProducts()|count}]
    [{capture append="oxidBlock_productbar" }]
        [{include file="widget/product/boxproducts.tpl" _boxId="similar"  _oBoxProducts=$oView->getSimilarProducts() _sHeaderIdent="WIDGET_PRODUCT_RELATED_PRODUCTS_SIMILAR_HEADER" _sHeaderCssClass="lightHead"}]
    [{/capture}]
[{/if }]

[{ if $oView->getAccessoires()|count}]
    [{capture append="oxidBlock_productbar"}]
        [{include file="widget/product/boxproducts.tpl" _boxId="accessories" _oBoxProducts=$oView->getAccessoires() _sHeaderIdent="WIDGET_PRODUCT_RELATED_PRODUCTS_ACCESSORIES_HEADER" _sHeaderCssClass="lightHead"}]
    [{/capture}]
[{/if }]

[{ if $oxidBlock_productbar}]
    <div id="relProducts" class="relatedProducts">
      [{foreach from=$oxidBlock_productbar item="_block"}]
        [{$_block}]
      [{/foreach}]
    </div>
[{/if }]
