


<body>
<script type="text/javascript">
var embeddedPPFlow1 = new PAYPAL.apps.DGFlow( {trigger : 'btnthreem'});
var embeddedPPFlow2 = new PAYPAL.apps.DGFlow( {trigger : 'btnhyear'});
var embeddedPPFlow3 = new PAYPAL.apps.DGFlow( {trigger : 'btnyear'});
var embeddedPPFlow4 = new PAYPAL.apps.DGFlow( {trigger : 'btnlife'});
var embeddedPPFlow5 = new PAYPAL.apps.DGFlow( {trigger : 'btnweek'})

function MyEmbeddedFlow(embeddedFlow) {
<?
$gg_key =  time();
?>
this.embeddedPPObj = embeddedFlow;
this.paymentSuccess = function() {
this.embeddedPPObj.closeFlow();
window.location.href = "http://www.dinglesgames.com/tools/login/?type=3&key=<?echo $gg_key?>&pay=paypal";
};
this.paymentCanceled = function() {
this.embeddedPPObj.closeFlow();
window.location.href = "http://www.dinglesgames.com/";
};

}
var myEmbeddedPaymentFlow1 = new MyEmbeddedFlow(embeddedPPFlow1);
var myEmbeddedPaymentFlow2 = new MyEmbeddedFlow(embeddedPPFlow2);
var myEmbeddedPaymentFlow3 = new MyEmbeddedFlow(embeddedPPFlow3);
var myEmbeddedPaymentFlow4 = new MyEmbeddedFlow(embeddedPPFlow4);
var myEmbeddedPaymentFlow5 = new MyEmbeddedFlow(embeddedPPFlow5);
</script>

<H3>Pay By PayPal</H3>
<p>Paying by PayPal you can activate your membership within seconds. After confirmation Paypal will redirect you to the login page, here just login or register as a new user and your membership will be activated.</p>
<p>You will have to have popups enabled for PayPal to work <a href="http://www.lbl.gov/ehs/training/webcourses/globalAssets/CourseRequirements/disablePopups/disablepopups.html">Link: How to disable popup blocker</a></p>
<p>Any problems with access please read this page <a href="http://www.dinglesgames.com/how-to-guide/having-trouble-accessing-monster-create/" target="Help Page"><u>Help with cookies</u></a>. If you still have problems or have any queries please contact me at paul(at)dinglesgames.com</p>


<h4>PayPal Digital Goods Express</h4>
<p><b>1 week membership</b> $1</p>

<p><a href="/paypalpay?item_number=week" id="btnweek"><img border="0" src="https://www.paypal.com/en_US/i/btn/btn_dg_pay_w_paypal.gif" /></a></p>
<p><b>3 month membership</b> $8</p>

<p><a href="/paypalpay?item_number=threem" id="btnthreem"><img border="0" src="https://www.paypal.com/en_US/i/btn/btn_dg_pay_w_paypal.gif" /></a></p>

<p><b>6 month membership</b> $15</p>
<p><a href="/paypalpay?item_number=hyear" id="btnhyear"><img border="0" src="https://www.paypal.com/en_US/i/btn/btn_dg_pay_w_paypal.gif" /></a></p>

<p><b>1 years membership</b> $25.00</p>
<p><a href="/paypalpay?item_number=year" id="btnyear"><img border="0" src="https://www.paypal.com/en_US/i/btn/btn_dg_pay_w_paypal.gif" /></a></p>

<p><b>lifetime membership</b> $40.00</p>
<p><a href="/paypalpay?item_number=life" id="btnlife"><img border="0" src="https://www.paypal.com/en_US/i/btn/btn_dg_pay_w_paypal.gif" /></a></p>

</body>
<?
 include 'paypal.php';
?>