<?php

namespace ItvisionSy\Validator\tests;

use ItvisionSy\Validator;

/**
 * Description of ValidatorTest
 *
 * @author muhannad
 */
class ValidatorTest extends PHPUnit_Framework_TestCase {

    public function testInitialization() {
        $validator = Validator\Validator::make(['name' => 'required'], ['name' => 'Ahmand']);
        $this->assertEquals(true, $validator->validate());
    }

}
