<?php

namespace ItvisionSy\Validator;

/**
 * Description of MaxValidatorRule
 *
 * @author Muhannad Shelleh <muhannad.shelleh@itvision-sy.com>
 */
class MaxValidatorRule extends ValidatorRule {

    protected $args = ['max'];

    protected function _validate($value) {
        if (is_numeric($value)) {
            return strlen($value) <= $this->max? : "Value length should be {$this->max} at max";
        } elseif (is_string($value)) {
            return $value <= $this->max? : "Value should be equal to or less than {$this->max}";
        }
    }

}
