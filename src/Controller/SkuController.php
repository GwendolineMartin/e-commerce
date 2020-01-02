<?php

namespace App\Controller;

use App\Entity\Sku;
use App\Form\SkuType;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class SkuController extends AbstractFOSRestController
{
    /**
     * Lists all Skus.
     * @Rest\Get("/skus")
     *
     * @return Response
     */
    public function getSkusAction(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Sku::class);
        $skus = $repository->findall();
        return $this->handleView($this->view($skus));
    }

    /**
     * Retrieves a Sku resource
     * @Rest\Get("/skus/{skuId}")
     *
     * @return Response
     */
    public function getSkuAction(int $skuId): Response
    {
        $repository = $this->getDoctrine()->getRepository(Sku::class);
        $sku = $repository->findById($skuId);
        // In case our GET was a success we need to return a 200 HTTP OK response with the request object
        if($sku) {
            return $this->handleView($this->view($sku, Response::HTTP_OK));
        }

        return $this->handleView($this->view(['error' => 'SKU not found'], Response::HTTP_NOT_FOUND));

    }


    /**
     * Create a sku
     *
     * @Rest\Post("/skus")
     *
     * @return Response
     */
    public function postSkuAction(Request $request): Response
    {
        $sku = new Sku();
        $form = $this->createForm(SkuType::class, $sku);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($sku);
            $doctrine->flush();


// In case our POST was a success we need to return a 201 HTTP CREATED response
            return $this->handleView($this->view($sku, Response::HTTP_CREATED));
        }
        return $this->handleView($this->view($form->getErrors()));
    }


    /**
     * Edit Sku resource
     * @Rest\Put("/skus/{id}")
     *
     * @return Response
     */
    public function editBrandAction(Request $request, int $id): Response
    {
        $sku = $this->getDoctrine()->getRepository(Sku::class)->find($id);

        if(!$sku) {
            return $this->handleView($this->view(['error' => 'Sku not found'], Response::HTTP_NOT_FOUND));
        }

        $form = $this->createForm(SkuType::class, $sku);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {

            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->merge($sku);
            $doctrine->flush();
            return $this->handleView($this->view($sku, Response::HTTP_OK));
        } else {
            return $this->handleView($this->view($form->getErrors()));
        }
    }

    /**
     * Removes the Sku resource
     * @Rest\Delete("/skus/{id}")
     *
     * @return Response
     */
    public function deleteBrandAction(Sku $sku): Response
    {
        $doctrine = $this->getDoctrine()->getManager();
        $doctrine->remove($sku);
        $doctrine->flush();

        return $this->handleView($this->view(["msg" => "Sku removed with success"], Response::HTTP_OK));
    }

}
