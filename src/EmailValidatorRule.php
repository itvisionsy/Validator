<?php

namespace ItvisionSy\Validator;

/**
 * Description of EmailValidatorRule
 *
 * @author muhannad
 */
class EmailValidatorRule extends ValidatorRule {

    protected function _validate($value) {
        return !!filter_var($value, \FILTER_VALIDATE_EMAIL)?:"Value is not a valid email address";
    }

}
