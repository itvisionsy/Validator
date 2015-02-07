<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ItvisionSy\Validator\tests;

use ItvisionSy\Validator\Validator;
use PHPUnit_Framework_TestCase;

/**
 * Description of ValidatorTest
 *
 * @author muhannad
 */
class ValidatorTest extends PHPUnit_Framework_TestCase {

    public function testSettersAndGetters() {
        $validator = Validator::make(['name' => 'required'], ['name' => 'Ahmand']);
        $this->assertEquals(true, $validator->validate());
    }

}
