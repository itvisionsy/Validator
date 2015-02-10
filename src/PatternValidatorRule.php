<?php

namespace ItvisionSy\Validator;

/**
 * Description of PatternValidatorRule
 *
 * @author muhannad
 */
class PatternValidatorRule extends ValidatorRule {
    
    protected $args = ['pattern'];

    protected function _validate($value) {
        return !!preg_match($this->pattern, $value)?:"Value does not meet the required pattern";
    }

}
