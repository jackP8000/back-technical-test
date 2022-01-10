<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
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
}
