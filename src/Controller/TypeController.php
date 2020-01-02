<?php

namespace App\Controller;

use App\Entity\Type;
use App\Form\TypeType;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class TypeController extends AbstractFOSRestController
{
    /**
     * Lists all Types.
     * @Rest\Get("/types")
     *
     * @return Response
     */
    public function getTypesAction(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Type::class);
        $types = $repository->findall();
        return $this->handleView($this->view($types));
    }

    /**
     * Retrieves a Type resource
     * @Rest\Get("/types/{typeId}")
     *
     * @return Response
     */
    public function getTypeAction(int $typeId): Response
    {
        $repository = $this->getDoctrine()->getRepository(Type::class);
        $type = $repository->findById($typeId);
        // In case our GET was a success we need to return a 200 HTTP OK response with the request object
        if($type) {
            return $this->handleView($this->view($type, Response::HTTP_OK));
        }

        return $this->handleView($this->view(['error' => 'Type not found'], Response::HTTP_NOT_FOUND));
    }


    /**
     * Create a type
     *
     * @Rest\Post("/types")
     *
     * @return Response
     */
    public function postTypeAction(Request $request): Response
    {
        $type = new Type();
        $form = $this->createForm(TypeType::class, $type);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($type);
            $doctrine->flush();


// In case our POST was a success we need to return a 201 HTTP CREATED response
            return $this->handleView($this->view($type, Response::HTTP_CREATED));
        }
        return $this->handleView($this->view($form->getErrors()));
    }


    /**
     * Edit Type resource
     * @Rest\Put("/types/{id}")
     *
     * @return Response
     */
    public function editTypeAction(Request $request, int $id): Response
    {
        $type = $this->getDoctrine()->getRepository(Type::class)->find($id);

        if(!$type) {
            return $this->handleView($this->view(['error' => 'Type not found'], Response::HTTP_NOT_FOUND));
        }

        $form = $this->createForm(TypeType::class, $type);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {

            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->merge($type);
            $doctrine->flush();
            return $this->handleView($this->view($type, Response::HTTP_OK));
        } else {
            return $this->handleView($this->view($form->getErrors()));
        }
    }

    /**
     * Removes the Type resource
     * @Rest\Delete("/types/{id}")
     *
     * @return Response
     */
    public function deleteTypeAction(Type $type): Response
    {
        $doctrine = $this->getDoctrine()->getManager();
        $doctrine->remove($type);
        $doctrine->flush();

        return $this->handleView($this->view(["msg" => "Type removed with success"], Response::HTTP_OK));
    }

}
