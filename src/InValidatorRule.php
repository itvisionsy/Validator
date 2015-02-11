<?php

namespace ItvisionSy\Validator;

/**
 * Description of InValidatorRule
 *
 * @author Muhannad Shelleh <muhannad.shelleh@itvision-sy.com>
 */
class InValidatorRule extends ValidatorRule {

    protected function _validate($value) {
        return array_search($value, $this->parameters) !== false? : "Value should be one of these values: " . (implode(", ", $this->parameters));
    }

}
