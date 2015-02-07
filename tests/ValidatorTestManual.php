<?php

require_once 'vendor/autoload.php';

$validator = ItvisionSy\Validator\Validator::make(['name' => 'required']);
var_dump($validator->validate(), $validator->errors);

var_dump(\ItvisionSy\Validator\RequiredValidatorRule::quick(ItvisionSy\Validator\ValidatorRule::VALUE_IS_NOT_PROVIDED_AT_ALL));

var_dump(\ItvisionSy\Validator\ValidatorItem::quick(999, 'required'));
