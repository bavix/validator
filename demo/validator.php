<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

$validator = new \Bavix\Validator\Validator();

$data = [
    'login'     => 'rez1dent3',
    'lastName'  => 'Babichev',
    'firstName' => 'Maxim',
    'age'       => '123',
];

$response = $validator->apply($data, [
    'login'    => [
        'required',
        'lengthMin:3',
        'lengthMax:20',
    ],
    'lastName' => [
        'lengthMin:3',
        'lengthMax:20',
    ],
    'age'      => 'int|min:3|max:200',
]);

var_dump($response);
