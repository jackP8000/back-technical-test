<?php

namespace App\Service;

use App\Entity\Order;
use App\Entity\OrderLine;

class WeightService
{
    public function calculWeight(Order $order): int
    {
        $totalWeight = 0;

        /** @var OrderLine $line */
        foreach ($order->getLines() as $line)
        {
            $totalWeight += $line->getProduct()->getWeight() * $line->getQuantity();
        }

        return $totalWeight;
    }

    public function isHeavy(Order $order): bool
    {
        if($this->calculWeight($order) > Order::HEAVY_LIMIT){
            return true;
        }

        return false;
    }

    public function isSuperHeavy(Order $order): bool
    {
        if($this->calculWeight($order) > Order::SUPER_HEAVY_LIMIT){
            return true;
        }

        return false;
    }
}
