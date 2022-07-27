<?php

namespace App\Machine;

use App\Machine\PurchasedItemInterface;

class SimplePurchasedItem implements PurchasedItemInterface {
    
    private $itemQuantity;
    private $totalAmount;
    private $change;
    
    public function __construct($itemQuantity, $totalAmount, $change) {
        $this->itemQuantity = $itemQuantity;
        $this->total = $totalAmount;
        $this->change = $change;
    }
    
    public function getItemQuantity() {
        return $this->itemQuantity;
    }
    
    public function getTotalAmount() {
        return $this->totalAmount;
    }
    
    public function getChange() {
        return $this->change;
    }

    public function getChangeAsString() {
        return $this->change->getString();
    }
}