<?php

namespace ItvisionSy\Validator;

/**
 * Description of NumberValidatorRule
 *
 * @author muhannad
 */
class NumberValidatorRule extends ValidatorRule {

    protected function _validate($value) {
        return is_numeric($value)? : "Value should be a number";
    }

}
