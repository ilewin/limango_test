<?php

namespace App\Machine\Tests;

use PHPUnit\Framework\TestCase;
use App\Machine\CigaretteMachine;

class CigaretteMachineTest extends TestCase {
    public function testCanCreateMachine() {
        $machine = new CigaretteMachine();
        $this->assertInstanceOf(CigaretteMachine::class, $machine);
    }
}