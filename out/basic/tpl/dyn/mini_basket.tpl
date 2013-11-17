[{ if $oxcmp_basket->getProductsCount()}]  <!-- $bl_perfShowRightBasket &&  -->
  [{oxhasrights ident="TOBASKET"}]
    [{assign var="currency" value=$oView->getActCurrency() }]
      <strong class="h2">
        <a id="test_[{$_basket_testid}]Header" rel="nofollow" href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=basket" }]">[{ oxmultilang ident="INC_RIGHTITEM_BASKET" }]</a>
      </strong>

      <div class="box minibasket">
      [{if $_basket_extended }]
        [{foreach from=$oxcmp_basket->getContents() name=rightlist item=_product}]
        <div id="test_[{$_basket_testid}]Title_[{$_product->getProductId()}]_[{$smarty.foreach.rightlist.iteration}]" class="listitem">
          [{ assign var="sRightListArtTitle" value=$_product->getTitle() }]
          <a id="test_[{$_basket_testid}]Pic_[{$_product->getProductId()}]_[{$smarty.foreach.rightlist.iteration}]" href="[{$_product->getLink()}]" class="picture">
              <img src="[{$_product->getImageUrl()}]/[{$_product->getIcon()}]" alt="[{ $sRightListArtTitle|strip_tags }]">
          </a>
          <a id="test_[{$_basket_testid}]TitleLink_[{$_product->getProductId()}]_[{$smarty.foreach.rightlist.iteration}]" href="[{$_product->getLink()}]" class="arttitle">[{ $sRightListArtTitle|strip_tags }]</a>
          <br>
          ( [{$_product->getAmount()}] [{ oxmultilang ident="INC_CMP_BASKET_QTY" }] )
         </div>
         [{/foreach}]

       <div class="hr"></div>
       [{/if}]

        <table class="total">
          <tr>
            <th>[{ oxmultilang ident="INC_CMP_BASKET_PRODUCT" }]</th>
            <td id="test_[{$_basket_testid}]Products">[{ $oxcmp_basket->getProductsCount()}]</td>
          </tr>
          <tr>
            <th>[{ oxmultilang ident="INC_CMP_BASKET_QUANTITY" }]</th>
            <td id="test_[{$_basket_testid}]Items">[{ $oxcmp_basket->getItemsCount()}]</td>
          </tr>
          [{ if $oxcmp_basket->getFDeliveryCosts() }]
            <tr>
              <th>[{ oxmultilang ident="INC_CMP_BASKET_SHIPPING" }]</th>
              <td id="test_[{$_basket_testid}]Shipping">[{ $oxcmp_basket->getFDeliveryCosts() }] [{ $currency->sign}] </td>
            </tr>
          [{ /if}]
          <tr>
            <th><b>[{ oxmultilang ident="INC_CMP_BASKET_TOTALPRODUCTS" }]</b></th>
            <td id="test_[{$_basket_testid}]Total"><b>[{ $oxcmp_basket->getFProductsPrice()}] [{ $currency->sign}]</b></td>
          </tr>
        </table>

        <div class="hr"></div>

        <form action="[{ $oViewConf->getSelfActionLink() }]" method="post">
          <div class="ta_right">
              [{ $oViewConf->getHiddenSid() }]
              <input type="hidden" name="cl" value="basket">
              <div class="tocart"><input id="test_[{$_basket_testid}]Open" type="submit" class="btn" value="[{ oxmultilang ident="INC_RIGHTITEM_DISPLAYBASKET" }]"></div>
          </div>
        </form>

     </div>
  [{/oxhasrights}]
[{/if}]