<?
define("PayPal_URL","https://api-3t.paypal.com/nvp"); // Live URL
//define("PayPal_URL","https://api.sandbox.paypal.com/nvp"); // SandBox URL

//define("API_USERNAME", "paul_api1.dinglesgames.com"); // sandbox merchant
define("API_PASSWORD", "N8WQVRYS2BV6SZC8"); // sandbox password
define("API_SIGNATURE","AFcWxV21C7fd0v3bYYYRCpSSRl31A6tZA3NUVQ79mbkjn7mkZcd88RxL"); // sandbox signature
define("API_USERNAME", "paul_api1.dinglesgames.com"); // sandbox merchant
define("API_VERSION", "97.0");
//define("API_PASSWORD", "AVd3bRCg9fmHM5oi0T5iDW2XZZXevtvPmsxP0QpLov7wAjFlpuBZfc5lCbUI"); // sandbox password
//define("API_SIGNATURE","EMKKVhDibMzxRgwnUtqlyBfd0obRShuF1esS1_tFxzYYqlhdC6RjEE3upv9r"); // sandbox signature

function outputArrayValues($array){
while (list($key, $value) = each($array))
{
if ("" != $value)
{
echo "$key = $value ";
}
}
}

function NVPEncode($nvps) {
$out = array();
foreach($nvps as $index => $value) {
$out[] = $index . "=" . urlencode($value);
}

return implode("&", $out);
}

function NVPDecode($nvp) {
$split = explode("&", $nvp);
$out = array();
foreach($split as $value) {
$sub = explode("=", $value);
$out[$sub[0]] = urldecode($sub[1]);
}

return $out;
}

function RunAPICall($nvps) {
$ch = curl_init(PayPal_URL);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

// On some servers, these two options are necessary to
// avoid getting “invalid SSL certificate” errors
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

// Insert the credentials
$nvps["USER"] = API_USERNAME;
$nvps["PWD"] = API_PASSWORD;
$nvps["SIGNATURE"] = API_SIGNATURE;
$nvps["VERSION"] = API_VERSION;

// Build the NVP string
$nvpstr = NVPEncode($nvps);
//echo "</BR>nvpstr = $nvpstr";
curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpstr);

$result = curl_exec($ch);

// If the request failed, return an empty array.
if($result === FALSE) return array();

// Return the decoded response
else return NVPDecode($result);
}

function PaymentError() {
die("An error occurred.");
}

?>