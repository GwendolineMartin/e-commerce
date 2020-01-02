<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Form\BrandType;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class BrandController extends AbstractFOSRestController
{
    /**
     * Lists all Brands.
     * @Rest\Get("/brands")
     *
     * @return Response
     */
    public function getBrandsAction(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Brand::class);
        $brands = $repository->findall();
        return $this->handleView($this->view($brands));
    }

    /**
     * Retrieves a Brand resource
     * @Rest\Get("/brands/{brandId}")
     *
     * @return Response
     */
    public function getBrandAction(int $brandId): Response
    {
        $repository = $this->getDoctrine()->getRepository(Brand::class);
        $brand = $repository->findById($brandId);
        if($brand) {
            return $this->handleView($this->view($brand, Response::HTTP_OK));
        }

        return $this->handleView($this->view(['error' => 'Brand not found'], Response::HTTP_NOT_FOUND));
    }


    /**
     * Create a brand
     *
     * @Rest\Post("/brands")
     *
     * @return Response
     */
    public function postBrandAction(Request $request): Response
    {
        $brand = new Brand();
        $form = $this->createForm(BrandType::class, $brand);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($brand);
            $doctrine->flush();


// In case our POST was a success we need to return a 201 HTTP CREATED response
            return $this->handleView($this->view($brand, Response::HTTP_CREATED));
        }
        return $this->handleView($this->view($form->getErrors()));
    }


    /**
     * Edit Brand resource
     * @Rest\Put("/brands/{id}")
     *
     * @return Response
     */
    public function editBrandAction(Request $request, int $id): Response
    {
        $brand = $this->getDoctrine()->getRepository(Brand::class)->find($id);

        if(!$brand) {
            return $this->handleView($this->view(['error' => 'Brand not found'], Response::HTTP_NOT_FOUND));
        }

        $form = $this->createForm(BrandType::class, $brand);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {

            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->merge($brand);
            $doctrine->flush();
            return $this->handleView($this->view($brand, Response::HTTP_OK));
        } else {
            return $this->handleView($this->view($form->getErrors()));
        }
    }

    /**
     * Removes the Brand resource
     * @Rest\Delete("/brands/{id}")
     *
     * @return Response
     */
    public function deleteBrandAction(Brand $brand): Response
    {
        $doctrine = $this->getDoctrine()->getManager();
        $doctrine->remove($brand);
        $doctrine->flush();

        return $this->handleView($this->view(["msg" => "Brand removed with success"], Response::HTTP_OK));
    }

}
