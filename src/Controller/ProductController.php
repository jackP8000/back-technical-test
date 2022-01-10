<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/products", name="products_list")
     */
    public function index(ProductRepository $repository): Response
    {
        $products = $repository->findAll();

        $view = $this->view($products, 200);
        return $this->handleView($view);
    }

    /**
     * @Rest\Get(
     *     path = "/product/{id}",
     *     name = "product_show",
     *     requirements={"id"="\d+"},
     * )
     */
    public function show(Product $product): Response
    {
        $view = $this->view($product, 200);
        return $this->handleView($view);
    }
}
