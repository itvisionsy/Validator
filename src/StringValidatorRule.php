<?php

namespace ItvisionSy\Validator;

/**
 * Description of StringValidatorRule
 *
 * @author muhannad
 */
class StringValidatorRule extends ValidatorRule {

    protected function _validate($value) {
        return is_string($value)? : "Value should be a string";
    }

}
