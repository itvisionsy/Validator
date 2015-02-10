<?php

namespace ItvisionSy\Validator;

/**
 * Description of ValidatorRule
 *
 * @author muhannad
 */
abstract class ValidatorRule implements \ArrayAccess {

    const VALUE_IS_NOT_PROVIDED_AT_ALL = "ItvisionSy\\Validator\\Validator\\CONST::VALUE_IS_NOT_PROVIDED_AT_ALL";

    protected $parameters = [];
    protected $args = [];

    /**
     * If true, the validator will be run even against not provided values, which will be mentioned as the string in the constant VALUE_IS_NOT_PROVIDED_AT_ALL
     * @var boolean
     */
    protected $ignoreNotProvided = true;

    /**
     * Return an instance of ValidatorRule
     * @param array $parameters a map of values for the ValidatorRule to use in validation. Any key/value pair will be available as a direct attribute.
     * @return ValidatorRule
     */
    public static function make(array $parameters = null) {
        return new static($parameters);
    }

    /**
     * Quickly instantiate a ValidatorRule and runs it against a value
     * @param mixed $value the value to be validated
     * @param array $parameters a map of values for the ValidatorRule to use in validation. Any key/value pair will be available as a direct attribute.
     * @param null $ValidatorRule A reference variable to take the ValidatorRule back
     * @return true|string|string[] TRUE if validation succeeded, string or array of errors otherwise.
     */
    public static function quick($value, array $parameters = null, &$validatorRule = null) {
        $validatorRule = static::make($parameters);
        return $validatorRule->validate($value);
    }

    /**
     * 
     * @param array $parameters a map of values for the ValidatorRule to use in validation. Any key/value pair will be available as a direct attribute.
     */
    public function __construct(array $parameters = null) {
        if ($parameters) {
            $this->setParameters($parameters);
        }
    }

    /**
     * 
     * @param array $parameters
     * @return \ItvisionSy\Validator\ValidatorRule
     */
    public function setParameters(array $parameters) {
        $this->parameters = $parameters;
        return $this;
    }

    /**
     * The actual validation logic of the class
     * @param mixed $value the value to be validated
     * @return true|string|string[] TRUE if validation succeeded, string error or array of string errors otherwise.
     */
    abstract protected function _validate($value);

    /**
     * Returns a ValidatorRule[] which will be validated before validating this rule
     * @return ValidatorRule|ValidatorRule[]
     */
    protected function preRules() {
        return [];
    }

    /**
     * Returns a ValidatorRule[] which will be validated after successfully validating this rule
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
        if ($this->ignoreNotProvided && $value === static::VALUE_IS_NOT_PROVIDED_AT_ALL) {
            return true;
        }
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

    public function __get($name) {
        if (($index = array_search($name, $this->args)) !== false) {
            $name = $index;
        } elseif (substr($name, 0, 1) == '_') {
            $name = (int) substr($name, 1);
        }
        if (array_key_exists($name, $this->parameters)) {
            return $this->parameters[$name];
        }
    }

    public function offsetExists($offset) {
        return array_key_exists($key, $this->parameters);
    }

    public function offsetGet($offset) {
        return $this->parameters[$offset];
    }

    public function offsetSet($offset, $value) {
        $this->parameters[$offset] = $value;
    }

    public function offsetUnset($offset) {
        unset($this->parameters[$offset]);
    }

}
