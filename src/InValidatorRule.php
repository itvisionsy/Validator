<?php

namespace ItvisionSy\Validator;

/**
 * Description of InValidatorRule
 *
 * @author muhannad
 */
class InValidatorRule extends ValidatorRule {

    protected function _validate($value) {
        return array_search($value, $this->parameters) !== false? : "Value should be one of these values: " . (implode(", ", $this->parameters));
    }

}
