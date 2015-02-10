<?php

namespace ItvisionSy\Validator;

/**
 * Description of NotInValidatorRule
 *
 * @author muhannad
 */
class NotInValidatorRule extends ValidatorRule {

    protected function _validate($value) {
        return array_search($value, $this->parameters) === false? : "Value should not be one of these values: " . (implode(", ", $this->parameters));
    }

}
