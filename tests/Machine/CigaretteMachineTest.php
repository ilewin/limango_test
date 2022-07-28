<?php

namespace App\Machine\Tests;

use PHPUnit\Framework\TestCase;
use App\Machine\CigaretteMachine;
use App\Machine\SimplePurchaseTransaction;

class CigaretteMachineTest extends TestCase {
    // Only crucial variables are tested.
    public function testCanCreateMachine() {
        $machine = new CigaretteMachine();
        $this->assertInstanceOf(CigaretteMachine::class, $machine);
    }

    public function testThrowNotEnoughMoneyExeption(){
        $machine = new CigaretteMachine();
        $stub = $this->createMock(SimplePurchaseTransaction::class);
        $this->expectException(\Exception::class);
        $stub->method('getItemQuantity')->willReturn(1);
        $stub->method('getPaidAmount')->willReturn(3.00);
        $machine->execute($stub);

    }

    public function testCanExecuteMachine() {
        $machine = new CigaretteMachine();
        $stub = $this->createMock(SimplePurchaseTransaction::class);
        $stub->method('getItemQuantity')->willReturn(4);
        $stub->method('getPaidAmount')->willReturn(22.00);
        $item = $machine->execute($stub);
        $this->assertNotNull($item);
        $this->assertEquals( 19.96, $item->getTotalAmount());
        $this->assertEqualsCanonicalizing([["2", 1],["0.02",2]], $item->getChange());   
    }

}