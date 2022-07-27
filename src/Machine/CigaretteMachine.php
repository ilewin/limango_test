<?php

namespace App\Machine;
use App\Machine\SimplePurchasedItem;
/**
 * Class CigaretteMachine
 * @package App\Machine
 */
class CigaretteMachine implements MachineInterface
{
    const ITEM_PRICE = 4.99;
    
    // Euro Coins Set
    private $coinDen = array(
        '2' => 200,
        '1' => 100,
        '0.5' => 50,
        '0.2' => 20,
        '0.1' => 10,
        '0.05' => 5,
        '0.02' => 2,
        '0.01' => 1,     
    );
 

    /**
     * @param PurchaseTransactionInterface $purchaseTransaction
     *
     * @return PurchasedItemInterface
     */
    public function execute(PurchaseTransactionInterface $purchaseTransaction){
        
        $itemQuantity = $purchaseTransaction->getItemQuantity();
        $paidAmount = $purchaseTransaction->getPaidAmount();
        
        if ($paidAmount < self::ITEM_PRICE * $itemQuantity) {
            throw new \Exception('Not enough money.'); // TODO: Make Dedicated Exception
        }

        $totalAmount = round(self::ITEM_PRICE * $itemQuantity, 2);

        $changeF = $paidAmount - $totalAmount;
        $changeI = (int)($changeF * 100);
        $changeCoins  = array();
        
        // One of the 7 sins
        // TODO: Consider moving to a separate service.
        foreach ($this->coinDen as $coin => $value) {
            
            if ($changeI >= $value) {
                $coco = (int)($changeI / $value);
                $changeI -= (int)($value * $coco);
                $changeCoins[] = [$coin, $coco];
            }

            if ($changeI == 0) {
                break;
            }

        }
        return new SimplePurchasedItem($itemQuantity, $totalAmount, $changeCoins);
    }


}