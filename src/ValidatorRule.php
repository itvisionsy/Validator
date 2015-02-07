<?php

namespace ItvisionSy\Validator;

/**
 * Description of ValidatorRule
 *
 * @author muhannad
 */
abstract class ValidatorRule implements IValidatorRule {

    const VALUE_IS_NOT_PROVIDED_AT_ALL = "ItvisionSy\\Validator\\Validator\\CONST::VALUE_IS_NOT_PROVIDED_AT_ALL";

    /**
     * Return an instance of ValidatorRule
     * @return ValidatorRule
     */
    public static function make() {
        return new static();
    }

    /**
     * Quickly instantiate a ValidatorRule and runs it against a value
     * @param mixed $value the value to be validated
     * @return true|string|string[] TRUE if validation succeeded, string or array of errors otherwise.
     */
    public static function quick($value, &$validatorRule = null) {
        $validatorRule = static::make();
        return $validatorRule->validate($value);
    }

    /**
     * The actual validation logic of the class
     * @param mixed $value the value to be validated
     * @return true|string|string[] TRUE if validation succeeded, string error or array of string errors otherwise.
     */
    abstract protected function _validate($value);

    /**
     * 
     * @return ValidatorRule|ValidatorRule[]
     */
    protected function preRules() {
        return [];
    }

    /**
     * 
     * @return ValidatorRule|ValidatorRule[]
     */
    protected function postRules() {
        return [];
    }

    /**
     * Validates a value against the rule
     * @param mixed $value the value to be validated
     * @return true|string|string[] TRUE if validation succeeded, string or array of errors otherwise.
     */
    public function validate($value) {
        $errors = $this->preValidate($value);
        if ($errors === true) {
            $errors = $this->_validate($value);
        }
        if ($errors === true) {
            $errors = $this->postValidate($value);
        }
        return $errors;
    }

    /**
     * Executes the pre validation rules and returns.
     * @param mixed $value the value to be validated
     * @return true|string|string[] TRUE if validation succeeded, string or array of errors otherwise.
     */
    public function preValidate($value) {
        $result = false;
        foreach ((array) $this->preRules() as $rule) {
            $result = $rule->validate($value);
            if ($result !== true) {
                return $result;
            }
        }
        return true;
    }

    /**
     * Executes the post validation rules
     * @param mixed $value the value to be validated
     * @return true|string|string[] TRUE if validation succeeded, string or array of errors otherwise.
     */
    public function postValidate($value) {
        $result = false;
        foreach ((array) $this->postRules() as $rule) {
            $result = $rule->validate($value);
            if ($result !== true) {
                return $result;
            }
        }
        return true;
    }

}
