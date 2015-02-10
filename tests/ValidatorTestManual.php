<?php

use ItvisionSy\Validator\Validator;
use ItvisionSy\Validator\ValidatorRule;

ini_set('display_errors', true);
require_once '../vendor/autoload.php';
//$validator = ItvisionSy\Validator\Validator::make(['name' => 'required']);
//var_dump($validator->validate(), $validator->errors);
//var_dump(\ItvisionSy\Validator\RequiredValidatorRule::quick(ItvisionSy\Validator\ValidatorRule::VALUE_IS_NOT_PROVIDED_AT_ALL));
//var_dump(\ItvisionSy\Validator\ValidatorItem::quick(999, 'required'));
$rules = [
    'name' => 'required|string|min:4',
    'page' => 'required|url|domain:gmail.com',
    'email' => 'required|email|domain:gmail.com',
    'age' => 'required|number|min:18|max:99',
    'agree' => 'required|not_in:no,false,0,|in:yes,true,1',
    'reversable' => function($value) {
        return $value = ValidatorRule::VALUE_IS_NOT_PROVIDED_AT_ALL || $value === strrev($value)? : "The extra value is not reversable";
    }
];
$data = [
    'name' => 'Samer',
    'page' => 'http://www.gmail.com/apps/gmail',
    'email' => 'test@gmail.com',
    'age' => '19',
    'agree' => 'yes',
//    'reversable' => 'naban'
];
var_dump(Validator::quick($rules, $data, $validator));
