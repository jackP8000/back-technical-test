<?php

namespace App\Service;

use App\Entity\Order;

class IssuesService
{
    private LocationService $locationService;
    private WeightService $weightService;

    public function __construct(LocationService $locationService, WeightService $weightService){

        $this->locationService = $locationService;
        $this->weightService = $weightService;
    }
    public function haveIssues(Order $order): bool
    {
        if(empty($order->getContactEmail())){
            return true;
        }

        if(!$this->locationService->isValidAddress($order->getShippingAddress().' '.$order->getShippingZipcode())){
            return true;
        };

        if($this->weightService->isSuperHeavy($order)){
            return true;
        }

        return false;
    }
}
