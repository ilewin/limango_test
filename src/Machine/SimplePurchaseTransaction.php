<?php

namespace App\Machine;

class SimplePurchaseTransaction implements PurchaseTransactionInterface{
    
    private $itemQuantity;
    private $paidAmount;

    public function __construct($itemQuantity, $paidAmount) {
        $this->itemQuantity = $itemQuantity;
        $this->paidAmount = $paidAmount;
    }

    /**
     * @return integer
     */
    public function getItemQuantity(){
        return $this->itemQuantity;
    }

    /**
     * @return float
     */
    public function getPaidAmount(){
        return $this->paidAmount;
    }
}