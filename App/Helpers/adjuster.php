<?php
$id = $_POST['id'] ?? '';
$amount = (int)$_POST['amount'] ?? '';
$operation = $_POST['operation'] ?? '';
$newAmount = ($operation == 'plus') ? $amount + 1 : $amount - 1;

if (!empty($id)) {
    /*
    $pizza = \App\Models\Pizza::getOne($id) ?? null;

    if (!is_null($pizza)) {
        $pizza->setAmount($newAmount);
        $pizza->save();
        echo $newAmount;
    } else {
        echo 0;
    }
    */
    echo $amount;
}
