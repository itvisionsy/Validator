<?php

namespace ItvisionSy\Validator\tests;

use ItvisionSy\Validator;

/**
 * Description of ValidatorTest
 *
 * @author Muhannad Shelleh <muhannad.shelleh@itvision-sy.com>
 */
class ValidatorTest extends PHPUnit_Framework_TestCase {

    public function testInitialization() {
        $validator = Validator\Validator::make(['name' => 'required'], ['name' => 'Ahmand']);
        $this->assertEquals(true, $validator->validate());
    }

}
