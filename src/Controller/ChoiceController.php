<?php

namespace App\Controller;

use App\Entity\Choice;
use App\Form\ChoiceType;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class ChoiceController extends AbstractFOSRestController
{
    /**
     * Lists all Choices.
     * @Rest\Get("/choices")
     *
     * @return Response
     */
    public function getChoicesAction(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Choice::class);
        $choices = $repository->findall();
        return $this->handleView($this->view($choices));
    }

    /**
     * Retrieves a Choice resource
     * @Rest\Get("/choices/{choiceId}")
     *
     * @return Response
     */
    public function getChoiceAction(int $choiceId): Response
    {
        $repository = $this->getDoctrine()->getRepository(Choice::class);
        $choice = $repository->findById($choiceId);
        // In case our GET was a success we need to return a 200 HTTP OK response with the request object
        if($choice) {
            return $this->handleView($this->view($choice, Response::HTTP_OK));
        }

        return $this->handleView($this->view(['error' => 'Choice not found'], Response::HTTP_NOT_FOUND));
    }


    /**
     * Create a choice
     *
     * @Rest\Post("/choices")
     *
     * @return Response
     */
    public function postChoiceAction(Request $request): Response
    {
        $choice = new Choice();
        $form = $this->createForm(ChoiceType::class, $choice);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($choice);
            $doctrine->flush();


// In case our POST was a success we need to return a 201 HTTP CREATED response
            return $this->handleView($this->view($choice, Response::HTTP_CREATED));
        }
        return $this->handleView($this->view($form->getErrors()));
    }


    /**
     * Edit Choice resource
     * @Rest\Put("/choices/{id}")
     *
     * @return Response
     */
    public function editChoiceAction(Request $request, int $id): Response
    {
        $choice = $this->getDoctrine()->getRepository(Choice::class)->find($id);

        if(!$choice) {
            return $this->handleView($this->view(['error' => 'Choice not found'], Response::HTTP_NOT_FOUND));
        }

        $form = $this->createForm(ChoiceType::class, $choice);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {

            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->merge($choice);
            $doctrine->flush();
            return $this->handleView($this->view($choice, Response::HTTP_OK));
        } else {
            return $this->handleView($this->view($form->getErrors()));
        }
    }

    /**
     * Removes the Choice resource
     * @Rest\Delete("/choices/{id}")
     *
     * @return Response
     */
    public function deleteChoiceAction(Choice $choice): Response
    {
        $doctrine = $this->getDoctrine()->getManager();
        $doctrine->remove($choice);
        $doctrine->flush();

        return $this->handleView($this->view(["msg" => "Choice removed with success"], Response::HTTP_OK));
    }

}
