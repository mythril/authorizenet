<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use Mythril\AuthorizeNet as A;

$cfg = include(__DIR__ . '/../../config.php');

$api = new A\API(
	$cfg['name'],
	$cfg['tk'],
	$cfg['sandbox']
);

$details = new A\TransactionRequest('authCaptureTransaction', '20.00');

$details->add(new A\Order());

$customer = new A\Customer();
$customer->email('luke@stoysnet.com');
$details->add($customer);

$billTo = new A\BillTo();
$billTo->firstName('Lucas')
		->lastName('Green')
		->company('STN')
		->address('410 NE 3rd St #8')
		->city('McMinnville')
		->state('OR')
		->country('USA')
		->zip('97128');
$details->add($billTo);

$settings = new A\HostedPaymentSettings();
$settings->showBillingAddress(true)
		->requireBillingAddress(true)
		->buttonText('Purchase')
		->showEmail(true)
		->requireEmail(true)
		->requireCardCode(true)
		->returnUrl($cfg['test_base'] . '/tests/front/confirm.php')
		->cancelUrl($cfg['test_base'] . '/tests/front/cancel.php')
		->useCaptcha(false)
		->showShippingAddress(false)
		->requireShippingAddress(false)
		->bgColor('EE00EE');

try {
//echo (json_encode($details->getData(), JSON_PRETTY_PRINT));die;
$getPage = new A\GetAcceptPaymentPage($details, $settings);

//echo json_encode($getPage->getPayload(array()), JSON_PRETTY_PRINT);die;

$result = $api->execute($getPage);

//print_r($result);die;
} catch (Exception $e) {
	echo $e, "\n";
	echo json_encode($getPage->getPayload(array()), JSON_PRETTY_PRINT);
	exit;
}

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
<!--
<?php
print_r($getPage);
?>
-->
</head>
<body>
	<form action="<?= $api->hostedUrl()?>" method="POST">
		<input type="hidden" name="token" value="<?= htmlentities($result->getToken()) ?>" />
		<input type="submit" value="SUBMIT WEAKLING" />
	</form>
</body>
</html>



