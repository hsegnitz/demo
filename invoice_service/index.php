<?php

require_once 'vendor/autoload.php';

function getInvoice($id)
{
    $faker = Faker\Factory::create();
    $faker->seed($id);

    $items = [];
    $numberOfItems = $faker->numberBetween(1, 3);
    for ($i = 0; $i < $numberOfItems; $i++) {
        $items[] = getItem($faker->numberBetween(1));
    }

    $gross = array_sum(array_column($items, 'grossLinePrice'));

    return [
        'id' => $id,
        'organisation' => $faker->company,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'street' => $faker->streetName,
        'housenumber' => $faker->numberBetween(1, 400) . ' ' . $faker->streetSuffix,
        'zipcode' => $faker->postcode,
        'state' => $faker->state,
        'city' => $faker->city,
        'email' => $faker->companyEmail,
        'items' => $items,
        'net' => array_sum(array_column($items, 'netLinePrice')),
        'gross' => $gross,
        'vat' => array_sum(array_column($items, 'lineVat')),
        'paid' => $faker->optional(0.1, $gross)->randomFloat(2, 0, $gross * 1.1),
    ];
}

function getItem($id)
{
    $faker = Faker\Factory::create();
    $faker->seed($id);

    $net            = $faker->randomFloat(2, 0.01, 10000);
    $vatRate        = $faker->randomDigit === 0 ? 7 : 19;
    $vat            = ($net / 100) * $vatRate;
    $gross          = add($net, $vat);
    $quantity       = $faker->numberBetween(1, 5);

    return [
        'id' => $id,
        'name' => $faker->words($faker->numberBetween(1, 5)),
        'description' => $faker->sentences($faker->numberBetween(1, 3)),
        'quantity' => $quantity,
        'vatRate' => $vatRate,
        'netItemPrice' => $net,
        'itemVat' => $vat,
        'grossItemPrice' => $gross,
        'netLinePrice' => $net * $quantity,
        'grossLinePrice' => $gross * $quantity,
        'lineVat' => $vat * $quantity,
    ];
}

// adding is something we really need to outsource into a microservice! Too much complexity!!!111oneeleven
function add($val1, $val2)
{
    return json_decode(file_get_contents("http://adding/?numbers[0]={$val1}&numbers[1]={$val2}"), JSON_OBJECT_AS_ARRAY)['result'];
}

if (! isset($_GET['invoice'])) {
    die('[]');
}

$invoices = $_GET['invoice'];
if (!is_array($invoices)) {
    $invoices = [$invoices];
}

$ret = [];
foreach ($invoices as $invoiceId) {
    $ret[$invoiceId] = getInvoice($invoiceId);
}

if (count($ret) === 1) {
    $ret = array_pop($ret);
}

echo json_encode($ret, JSON_PRETTY_PRINT);
