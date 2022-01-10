<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderLine;
use App\Repository\OrderRepository;
use App\Service\IssuesService;
use App\Service\LocationService;
use App\Service\WeightService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/orders", name="orders_list")
     */
    public function index(OrderRepository $repository): Response
    {
        $orders = $repository->findAll();

        $view = $this->view($orders, 200);
        return $this->handleView($view);
    }

    /**
     * @Rest\Get(
     *     path = "/order/{id}",
     *     name = "order_show",
     *     requirements={"id"="\d+"},
     * )
     */
    public function show(Order $order): Response
    {
        $view = $this->view($order, 200);
        return $this->handleView($view);
    }

    /**
     * @Rest\Patch(
     *     path = "/order/{id}/update_tags",
     *     name = "order_calcul-weight",
     *     requirements={"id"="\d+"},
     * )
     */
    public function addingTags(
        Order $order,
        EntityManagerInterface $manager,
        LocationService $locationService,
        WeightService $weightService,
        IssuesService $issuesService
    ): Response
    {

        if($weightService->isHeavy($order)){
            $order->addTag(Order::HEAVY_TAG);
        }

        if(!$order->getShippingCountry() ==  "France"){
            $order->addTag(Order::FOREIGN_ORDER_TAG);
        }

        if($issuesService->haveIssues($order)){
            $order->addTag(Order::ISSUES_TAG);
        }

        $manager->flush();

        $view = $this->view($order, 200);

        return $this->handleView($view);
    }
}
