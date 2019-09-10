<?php
$client = $_GET['client'] ?? 0;

if ($client < 1) {
	include 'home.php';
	return;
}

$url = 'http://client/?client=' . $client;

$client = json_decode(file_get_contents($url), JSON_OBJECT_AS_ARRAY);

?>
<html>
	<head>
		<title>Super Safe Billing Application</title>
	</head>
	<body>
		<h1>Super Safe Billing Application</h1>
		<h2>Invoices</h2>

		<!-- maybe client details? -->

		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>Company</th>
					<th>Items</th>
					<th>Net</th>
					<th>Gross</th>
					<th>Vat</th>
					<th>Paid</th>
					<th>actions</th>
				</tr>
			</thead>
			<tbody>
			<?php

			$url = 'http://invoice/?asd=wtf';
			foreach ($client['invoices'] as $id) {
				$url .= '&invoice[]=' . $id;
			}

            $invoices = json_decode(file_get_contents($url), JSON_OBJECT_AS_ARRAY);

			foreach ($invoices as $invoice) {
                ?>
				<tr>
					<td><?php echo $invoice['id']; ?></td>
					<td><?php echo $invoice['organisation']; ?></td>
					<td><?php echo count($invoice['items']); ?></td>
					<td style="text-align: right;"><?php echo number_format($invoice['net'], 2); ?> €</td>
					<td style="text-align: right;"><?php echo number_format($invoice['gross'], 2); ?> €</td>
					<td style="text-align: right;"><?php echo number_format($invoice['vat'], 2); ?> €</td>
					<td style="text-align: right;"><?php echo number_format($invoice['paid'], 2); ?> €</td>
					<td><a href="index.php?action=details&invoice=<?php echo $invoice['id']; ?>">show details</a></td>
				</tr>
                <?php
            }
			?>
			</tbody>
		</table>
	</body>
</html>