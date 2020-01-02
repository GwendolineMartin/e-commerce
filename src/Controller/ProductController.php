<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\Product1Type;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class ProductController extends AbstractFOSRestController
{
    /**
     * Lists all Products.
     * @Rest\Get("/products")
     *
     * @return Response
     */
    public function getProductsAction(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Product::class);
        $products = $repository->findall();
        return $this->handleView($this->view($products));
    }

    /**
     * Retrieves a Product resource
     * @Rest\Get("/products/{productId}")
     *
     * @return Response
     */
    public function getProductAction(int $productId): Response
    {
        $repository = $this->getDoctrine()->getRepository(Product::class);
        $product = $repository->findById($productId);
        // In case our GET was a success we need to return a 200 HTTP OK response with the request object
        if($product) {
            return $this->handleView($this->view($product, Response::HTTP_OK));
        }

        return $this->handleView($this->view(['error' => 'Product not found'], Response::HTTP_NOT_FOUND));
    }


    /**
     * Create a product
     *
     * @Rest\Post("/products")
     *
     * @return Response
     */
    public function postProductAction(Request $request): Response
    {
        $product = new Product();
        $form = $this->createForm(Product1Type::class, $product);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($product);
            $doctrine->flush();


// In case our POST was a success we need to return a 201 HTTP CREATED response
            return $this->handleView($this->view($product, Response::HTTP_CREATED));
        }
        return $this->handleView($this->view($form->getErrors()));
    }


    /**
     * Edit Product resource
     * @Rest\Put("/products/{id}")
     *
     * @return Response
     */
    public function editProductAction(Request $request, int $id): Response
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        if(!$product) {
            return $this->handleView($this->view(['error' => 'Product not found'], Response::HTTP_NOT_FOUND));
        }

        $form = $this->createForm(Product1Type::class, $product);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {

            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->merge($product);
            $doctrine->flush();
            return $this->handleView($this->view($product, Response::HTTP_OK));
        } else {
            return $this->handleView($this->view($form->getErrors()));
        }
    }

    /**
     * Removes the Product resource
     * @Rest\Delete("/products/{id}")
     *
     * @return Response
     */
    public function deleteProductAction(Product $product): Response
    {
        $doctrine = $this->getDoctrine()->getManager();
        $doctrine->remove($product);
        $doctrine->flush();

        return $this->handleView($this->view(["msg" => "Product removed with success"], Response::HTTP_OK));
    }

}
