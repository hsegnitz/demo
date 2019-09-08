<?php

require_once 'vendor/autoload.php';

function getClient($id)
{
    $faker = Faker\Factory::create();
    $faker->seed($id);

    $invoiceIds = [];
    $numberOfInvoices = $faker->numberBetween(0, 15);
    for ($i = 0; $i < $numberOfInvoices; $i++) {
        $invoiceIds[] = $faker->numberBetween(1);
    }

    return [
        'id' => $id,
        'organisation' => $faker->company,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'street' => $faker->streetName,
        'housenumber' => $faker->numberBetween(1, 400),
        'zipcode' => $faker->postcode,
        'state' => $faker->state,
        'city' => $faker->city,
        'email' => $faker->companyEmail,
        'invoices' => $invoiceIds,
    ];
}

if (! isset($_GET['client'])) {
    die('[]');
}

$clients = $_GET['client'];
if (!is_array($clients)) {
    $clients = [$clients];
}

$ret = [];
foreach ($clients as $clientId) {
    $ret[$clientId] = getClient($clientId);
}

if (count($ret) === 1) {
    $ret = array_pop($ret);
}

echo json_encode($ret, JSON_PRETTY_PRINT);
