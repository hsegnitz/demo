<?php

require_once 'vendor/autoload.php';

use SimplePHPEasyPlus\Number\NumberCollection;
use SimplePHPEasyPlus\Number\SimpleNumber;
use SimplePHPEasyPlus\Number\CollectionItemNumberProxy;
use SimplePHPEasyPlus\Parser\SimpleNumberStringParser;
use SimplePHPEasyPlus\Operator\AdditionOperator;
use SimplePHPEasyPlus\Operation\ArithmeticOperation;
use SimplePHPEasyPlus\Engine;
use SimplePHPEasyPlus\Calcul\Calcul;
use SimplePHPEasyPlus\Calcul\CalculRunner;


$numbers = [];
if (isset($_REQUEST['numbers'])) {
    $numbers = array_values($_REQUEST['numbers']);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = file_get_contents('php://input');
    if ('' !== $data) {
        $numbers = json_decode($data, JSON_OBJECT_AS_ARRAY);
        if (is_array($numbers)) {
            $numbers = array_values($numbers);
        }
    }
}


$numberCollection = new NumberCollection();

$numberParser = new SimpleNumberStringParser();

foreach ($numbers as $num) {
    $parsedNumber = $numberParser->parse($num);
    $number = new SimpleNumber($parsedNumber);
    $numberProxy = new CollectionItemNumberProxy($number);

    $numberCollection->add($numberProxy);
}

$addition = new AdditionOperator('SimplePHPEasyPlus\Number\SimpleNumber');

$operation = new ArithmeticOperation($addition);

$engine = new Engine($operation);

$calcul = new Calcul($engine, $numberCollection);

$runner = new CalculRunner();

$runner->run($calcul);

$result = $calcul->getResult();

echo json_encode(
    [
        'result' => $result->getValue(),
    ],
    JSON_PRETTY_PRINT
);
