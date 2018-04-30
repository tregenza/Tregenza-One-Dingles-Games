


<body>
<script type="text/javascript">

function linkhyear(){
<?
$Item = "hyear";
include($workingPath."/paypalpay2.php");
?>
}
function linkyear(){
<?
$Item = "year";
include($workingPath."/paypalpay2.php");
?>
}
function linklife(){
<?
$Item = "life";
include($workingPath."/paypalpay2.php");
?>
}
function linkdaysbought(){
<?
$Item = "daysbought";
include($workingPath."/paypalpay2.php");
?>
}

</script>
<style>
button{
  background-color:white;
  border:0px

}
</style>

<H3>Pay By PayPal</H3>
<p>Paying by PayPal you can activate your membership within seconds. After confirmation Paypal will redirect you to the login page, here just login or register as a new user and your membership will be activated.</p>
<p>Any problems with access please read this page <a href="http://www.dinglesgames.com/how-to-guide/having-trouble-accessing-monster-create/" target="Help Page"><u>Help with cookies</u></a>. If you still have problems or have any queries please contact me at paul(at)dinglesgames.com</p>


<h4>PayPal Digital Goods Express</h4>
<FORM METHOD="post" ACTION="http://www.dinglesgames.com">

<p><b>6 month membership</b> $15</p>
<p><button onclick="linkhyear()"><img src="https://www.paypal.com/en_US/i/btn/btn_dg_pay_w_paypal.gif" img border="0"></button></p>

<p><b>30 seperate days membership (over any time period)</b> $15</p>
<p><button onclick="linkdaysbought()"><img src="https://www.paypal.com/en_US/i/btn/btn_dg_pay_w_paypal.gif" img border="0"></button></p>

<p><b>1 years membership</b> $25.00</p>
<p><button onclick="linkyear()"><img src="https://www.paypal.com/en_US/i/btn/btn_dg_pay_w_paypal.gif" img border="0"></button></p>

<p><b>lifetime membership</b> $40.00</p>
<p><button onclick="linklife()"><img src="https://www.paypal.com/en_US/i/btn/btn_dg_pay_w_paypal.gif" img border="0"></button></p> 
</body>
<?
// include 'paypal.php';
?>