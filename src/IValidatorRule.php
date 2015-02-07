<?php

namespace ItvisionSy\Validator;

/**
 *
 * @author muhannad
 */
interface IValidatorRule {
    
    public static function make();
    
    public static function quick($value);

    /**
     * 
     * @param mixed $value the value to be validated
     * @return true|string|string[] TRUE if validation succeeded, string or array of errors otherwise.
     */
    public function validate($value);
}
