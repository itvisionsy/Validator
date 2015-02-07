<?php

namespace ItvisionSy\Validator;

/**
 * Description of RequiredValidatorRule
 *
 * @author muhannad
 */
class RequiredValidatorRule extends ValidatorRule {

    protected function _validate($value) {
        return $value !== static::VALUE_IS_NOT_PROVIDED_AT_ALL ? TRUE : "Value is required";
    }

}
