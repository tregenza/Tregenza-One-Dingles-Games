<?
$gg_key =  time();

?>


<form action="https://sandbox.google.com/checkout/api/checkout/v2/checkoutForm/Merchant/652924895539718" id="BB_BuyButtonForm" method="post" name="BB_BuyButtonForm">
    <table cellpadding="5" cellspacing="0" width="1%">
        <tr>
            <td align="right" width="1%">
                <select name="item_selection_1">
                    <option value="1">&#163;15.00 (GPB) - Yearly Membership</option>
                    <option value="2">&#163;25.00 (GBP) - Lifetime membership</option>
                </select>
                <input name="item_option_name_1" type="hidden" value="Yearly Membership"/>
                <input name="item_option_price_1" type="hidden" value="15.0"/>
                <input name="item_option_description_1" type="hidden" value="One Years membership to dinglesgames"/>
                <input name="item_option_quantity_1" type="hidden" value="1"/>
                <input name="item_option_currency_1" type="hidden" value="GBP"/>
                <input name="shopping-cart.item-options.items.item-1.digital-content.description" type="hidden" value="Click on the URL and then sign in to activate your account "/>
                <input name="shopping-cart.item-options.items.item-1.digital-content.key" type="hidden" value="KPOOeTn70bAF0BSud9Sfywl7qBPnV3BfRLjAHBEaKFQ="/>
                <input name="shopping-cart.item-options.items.item-1.digital-content.key.is-encrypted" type="hidden" value="true"/>
                <input name="shopping-cart.item-options.items.item-1.digital-content.url" type="hidden" value="http://www.dinglesgames.com/tools/login/?type=y&key=<?echo $gg_key?>"/>
                <input name="item_option_name_2" type="hidden" value="Lifetime membership"/>
                <input name="item_option_price_2" type="hidden" value="25.0"/>
                <input name="item_option_description_2" type="hidden" value="Lifetime membership to Dinglesgames"/>
                <input name="item_option_quantity_2" type="hidden" value="1"/>
                <input name="item_option_currency_2" type="hidden" value="GBP"/>
                <input name="shopping-cart.item-options.items.item-2.digital-content.description" type="hidden" value="Click on the URL and then sign in to to activate your account"/>
                <input name="shopping-cart.item-options.items.item-2.digital-content.key" type="hidden" value="kAsST2tRq+43Vv5p6s2Iomphc+UtEd3drE6RBpjby70="/>
                <input name="shopping-cart.item-options.items.item-2.digital-content.key.is-encrypted" type="hidden" value="true"/>
                <input name="shopping-cart.item-options.items.item-2.digital-content.url" type="hidden" value="http://www.dinglesgames.com/tools/login/?type=l&key=<?echo $gg_key?>"/>
            </td>
            <td align="left" width="1%">
                <input alt="" src="https://sandbox.google.com/checkout/buttons/buy.gif?merchant_id=652924895539718&w=117&h=48&style=white&variant=text&loc=en_US" type="image"/>
            </td>
        </tr>
    </table>
</form>
