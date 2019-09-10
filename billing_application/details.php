<?php
$invoice = $_GET['invoice'] ?? 0;

if ($invoice < 1) {
	include 'home.php';
	return;
}

$url = 'http://invoice/?invoice=' . $invoice;

$invoice = json_decode(file_get_contents($url), JSON_OBJECT_AS_ARRAY);

?>
<html>
	<head>
		<title>Super Safe Billing Application</title>
	</head>
	<body>
		<h1>Super Safe Billing Application</h1>
		<h2>Invoice Details</h2>
		<pre><?php print_r($invoice); ?></pre>
	</body>
</html>
