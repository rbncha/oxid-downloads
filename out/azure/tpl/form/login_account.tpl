<div class="lineBlock"></div>
<br>

<div class="col">
    <form name="login" class="oxValidate" action="[{ $oViewConf->getSslSelfLink() }]" method="post">
        <div>
            [{ $oViewConf->getHiddenSid() }]
            [{ $oViewConf->getNavFormParams() }]
            <input type="hidden" name="fnc" value="login_noredirect">
            <input type="hidden" name="cl" value="[{ $oViewConf->getActiveClassName() }]">
            <input type="hidden" name="tpl" value="[{$oViewConf->getActTplName()}]">
            [{if $oView->getArticleId()}]
              <input type="hidden" name="aid" value="[{$oView->getArticleId()}]">
            [{/if}]
            [{if $oView->getProduct()}]
              [{assign var="product" value=$oView->getProduct() }]
              <input type="hidden" name="anid" value="[{ $product->oxarticles__oxnid->value }]">
            [{/if}]
        </div>

        <ul class="form clear">
            <li [{if $aErrors}]class="oxError"[{/if}]>
                <label>[{ oxmultilang ident="FORM_LOGIN_ACCOUNT_EMAIL" }]<span class="req">*</span></label>
                <input id="loginUser" class="oxValidate oxValidate_notEmpty" type="text" name="lgn_usr" value="" size="37" >
                <p class="oxValidateError">
                    <span class="oxError_notEmpty">[{ oxmultilang ident="EXCEPTION_INPUT_NOTALLFIELDS" }]</span>
                </p>
            </li>
            <li [{if $aErrors}]class="oxError"[{/if}]>
                <label>[{ oxmultilang ident="FORM_LOGIN_ACCOUNT_PWD" }]<span class="req">*</span></label>
                <input id="loginPwd" class="oxValidate oxValidate_notEmpty textbox" type="password" name="lgn_pwd" value="" size="37">
                <p class="oxValidateError">
                    <span class="oxError_notEmpty">[{ oxmultilang ident="EXCEPTION_INPUT_NOTALLFIELDS" }]</span>
                </p>
            </li>
            <li>
                <label>[{ oxmultilang ident="FORM_LOGIN_ACCOUNT_KEEPLOGGEDIN" }]</label>
                <input type="checkbox" class="checkbox" name="lgn_cook" value="1">
            </li>

            <li class="formSubmit">
                <button id="loginButton" type="submit" class="submitButton largeButton">[{ oxmultilang ident="FORM_LOGIN_ACCOUNT_LOGIN" }]</button>
            </li>
        </ul>
    </form>
</div>

<div class="col">
    <a id="openAccountLink" href="[{ oxgetseourl ident=$oViewConf->getSslSelfLink()|cat:"cl=register" }]" class="textLink" rel="nofollow">[{ oxmultilang ident="FORM_LOGIN_ACCOUNT_OPENACCOUNT" }]</a><br />
    <a id="forgotPasswordLink" href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=forgotpwd" }]" class="textLink" rel="nofollow">[{ oxmultilang ident="FORM_LOGIN_ACCOUNT_FORGOTPWD" }]</a>
</div>

<div class="clear"></div>