<?php

require_once 'vendor/autoload.php';

// paginate through endless list of clients

// detail view of client with list of invoices

// detail view of invoice


$client = json_decode(file_get_contents('http://client/?client=42'), JSON_OBJECT_AS_ARRAY);

print_r($client);

