<?php

namespace ItvisionSy\Validator;

/**
 * The bulk validation class.
 * 
 * It handles the instantiation and feeding of validation items and rules, and evaluating them.
 * 
 * Basically, you will not need to handle other validator classes manually unless you need to customize the validation.
 * When created, you provide it with the rules and the values, and you will get an associative array of errors if any.
 *
 * @author Muhannad Shelleh <muhannad.shelleh@itvision-sy.com>
 * 
 * @property-read ValidatorItem[] $items The items to be validated
 * @property-read string[] $errors An array of errors resulted from the last validation. If no errors then empty array
 */
class Validator {

    protected $items = [];
    protected $errors = [];
    protected $values = [];

    /**
     * Creates a validator
     * @param array $rules Array[key=>rules,...] to be checked against
     * @param array $values Array[key=>value,...] to be tested
     * @return Validator A validator object
     */
    public static function make(array $rules = null, array $values = null) {
        return new static($rules, $values);
    }

    /**
     * Quickly creats and validates a set of values against a set of rules
     * @param array $rules Array[key=>rules,...] to be checked against
     * @param array $values Array[key=>value,...] to be tested
     * @param null $validator a reference variable to receive the validator object back
     * @return boolean|array TRUE if validation succeeded, array of errors otherwise
     */
    public static function quick(array $rules, array $values, &$validator = null) {
        $validator = static::make($rules, $values);
        return $validator->validate()? : $validator->errors;
    }

    /**
     * 
     * @param array $rules Array[key=>rules,...] to be checked against
     * @param array $values Array[key=>value,...] to be tested
     */
    public function __construct(array $rules = null, array $values = null) {
        if ($values && is_array($values)) {
            $this->values = $values;
        }
        if ($rules && is_array($rules)) {
            foreach ($rules as $key => $itemRules) {
                $value = array_key_exists($key, $this->values) ? $this->values[$key] : ValidatorRule::VALUE_IS_NOT_PROVIDED_AT_ALL;
                $this->item($key, $value, $itemRules);
            }
        }
    }

    /**
     * Adds a new item to the validation
     * @param string|integer $key The key to be validated
     * @param mixed $value The value to be tested against the rules
     * @param string[]|string|ValidatorRule|ValidatorRule[] $rules The rules for the value to be tested against
     * @return \ItvisionSy\Validator\Validator
     */
    public function item($key, $value, $rules = null) {
        $this->items[$key] = ValidatorItem::make($value, $rules);
        return $this;
    }

    /**
     * Validates all the items
     * @return boolean TRUE if all validation failed, FALSE otherwise. Error information can be accessed by the $errors property
     */
    public function validate() {
        $errors = [];
        foreach ($this->items as $key => $item) {
            if (!$item->validate()) {
                $errors[$key] = $item->errors;
            }
        }
        $this->errors = $errors;
        return count($errors) == 0;
    }

    public function __get($name) {
        switch ($name) {
            case 'items':
                return $this->items;
            case 'errors':
                return $this->errors;
                break;
        }
    }

}
