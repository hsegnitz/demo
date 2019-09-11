<?php
$page = $_GET['page'] ?? 0;
?>
<html>
	<head>
		<title>Super Safe Billing Application</title>
	</head>
	<body>
		<h1>Super Safe Billing Application</h1>
		<h2>Clients</h2>
		<p><a href="index.php?action=clients&page=<?php echo ($page + 1); ?>">next page</a></p>

		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>Company</th>
					<th>Last Name</th>
					<th>First Name</th>
					<th>E-Mail</th>
					<th>Invoices</th>
					<th>actions</th>
				</tr>
			</thead>
			<tbody>
			<?php

			$ids = range(
				$page * 10,
				(($page+1) * 10) - 1
			);

			$url = 'http://client/?asd=wtf';
			foreach ($ids as $id) {
				$url .= '&client[]=' . $id;
			}

			$raw = file_get_contents($url);
			echo "<!-- $raw -->";
            $clients = json_decode($raw, JSON_OBJECT_AS_ARRAY);

			foreach ($clients as $client) {
                ?>
				<tr>
					<td><?php echo $client['id']; ?></td>
					<td><?php echo $client['organisation']; ?></td>
					<td><?php echo $client['first_name']; ?></td>
					<td><?php echo $client['last_name']; ?></td>
					<td><?php echo $client['email']; ?></td>
					<td><?php echo count($client['invoices']); ?></td>
					<td><a href="index.php?action=invoices&client=<?php echo $client['id']; ?>">show invoices</a></td>
				</tr>
                <?php
            }
			?>
			</tbody>
		</table>
	</body>
</html>