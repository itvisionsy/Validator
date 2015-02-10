<?php

namespace ItvisionSy\Validator;

/**
 * Description of UrlValidatorRule
 *
 * @author muhannad
 */
class UrlValidatorRule extends ValidatorRule {

    protected function _validate($value) {
        return !!filter_var($value, \FILTER_VALIDATE_URL)?:"Value is not a valid URL";
    }

}
