<?php

namespace App\Controller;

use App\Entity\Issues;
use App\Entity\Order;
use App\Service\LocationService;
use App\Service\WeightService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;

class IssuesController extends AbstractFOSRestController
{
    /**
     * @Rest\Get(
     *     path = "/order/{id}/issues",
     *     name = "order_issues_show",
     *     requirements={"id"="\d+"},
     * )
     */
    public function show(Order $order): Response
    {
        $view = $this->view($order->getIssues(), 200);
        return $this->handleView($view);
    }

    /**
     * @Rest\Post(
     *     path = "/order/{id}/issues",
     *     name = "order_issues_create",
     *     requirements={"id"="\d+"},
     * )
     */
    public function create(Order $order, LocationService $locationService, WeightService $weightService, EntityManagerInterface $manager): Response
    {
        if(is_null($issue = $order->getIssues())){
            $issue = new Issues();
        }

        if(!$locationService->isValidAddress($order->getShippingAddress().' '.$order->getShippingZipcode())){
            $issue->setInvalidAddressProblem();
        }

        if($weightService->isSuperHeavy($order)){
            $issue->setSuperHeavyProblem();
        }

        if(empty($order->getContactEmail())) {
            $issue->setEmailProblem();
        }

        $order->setIssues($issue);

        $manager->persist($issue);

        $manager->flush();

        $view = $this->view($order->getIssues(), 201);
        return $this->handleView($view);
    }

}
