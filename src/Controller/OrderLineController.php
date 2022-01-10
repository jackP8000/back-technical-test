<?php

namespace App\Controller;

use App\Entity\OrderLine;
use App\Repository\OrderLineRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;

class OrderLineController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/order-lines", name="order-lines_list")
     */
    public function index(OrderLineRepository $repository): Response
    {
        $orderLines = $repository->findAll();

        $view = $this->view($orderLines, 200);
        return $this->handleView($view);
    }

    /**
     * @Rest\Get(
     *     path = "/order-line/{id}",
     *     name = "order-line_show",
     *     requirements={"id"="\d+"},
     * )
     */
    public function show(OrderLine $orderLine): Response
    {
        $view = $this->view($orderLine, 200);
        return $this->handleView($view);
    }
}
