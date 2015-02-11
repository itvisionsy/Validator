<?php

namespace ItvisionSy\Validator;

/**
 * Description of MinValidatorRule
 *
 * @author Muhannad Shelleh <muhannad.shelleh@itvision-sy.com>
 */
class MinValidatorRule extends ValidatorRule {

    protected $args = ['min'];

    protected function _validate($value) {
        if (is_numeric($value)) {
            return $value >= $this->min? : "Value should be equal to or greater than {$this->min}";
        } elseif (is_string($value)) {
            return strlen($value) >= $this->min? : "Value length should be {$this->min} at least";
        }
    }

}
