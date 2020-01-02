<?php

namespace App\Controller;

use App\Entity\Profil;
use App\Form\ProfilType;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class ProfilController extends AbstractFOSRestController
{
    /**
     * Lists all Profil.
     * @Rest\Get("/profils")
     *
     * @return Response
     */
    public function getProfilsAction(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Profil::class);
        $profils = $repository->findall();
        return $this->handleView($this->view($profils));
    }

    /**
     * Retrieves a Profil resource
     * @Rest\Get("/profils/{profilId}")
     *
     * @return Response
     */
    public function getProfilAction(int $profilId): Response
    {
        $repository = $this->getDoctrine()->getRepository(Profil::class);
        $profil = $repository->findById($profilId);
        // In case our GET was a success we need to return a 200 HTTP OK response with the request object
        if($profil) {
            return $this->handleView($this->view($profil, Response::HTTP_OK));
        }

        return $this->handleView($this->view(['error' => 'Profil not found'], Response::HTTP_NOT_FOUND));
    }


    /**
     * Create a profil
     *
     * @Rest\Post("/profils")
     *
     * @return Response
     */
    public function postProfilAction(Request $request): Response
    {
        $profil = new Profil();
        $form = $this->createForm(ProfilType::class, $profil);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($profil);
            $doctrine->flush();


// In case our POST was a success we need to return a 201 HTTP CREATED response
            return $this->handleView($this->view($profil, Response::HTTP_CREATED));
        }
        return $this->handleView($this->view($form->getErrors()));
    }


    /**
     * Edit Profil resource
     * @Rest\Put("/profils/{id}")
     *
     * @return Response
     */
    public function editProfilAction(Request $request, int $id): Response
    {
        $profil = $this->getDoctrine()->getRepository(Profil::class)->find($id);

        if(!$profil) {
            return $this->handleView($this->view(['error' => 'Profil not found'], Response::HTTP_NOT_FOUND));
        }

        $form = $this->createForm(ProfilType::class, $profil);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {

            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->merge($profil);
            $doctrine->flush();
            return $this->handleView($this->view($profil, Response::HTTP_OK));
        } else {
            return $this->handleView($this->view($form->getErrors()));
        }
    }

    /**
     * Removes the Profil resource
     * @Rest\Delete("/profils/{id}")
     *
     * @return Response
     */
    public function deleteProfilAction(Profil $profil): Response
    {
        $doctrine = $this->getDoctrine()->getManager();
        $doctrine->remove($profil);
        $doctrine->flush();

        return $this->handleView($this->view(["msg" => "Profil removed with success"], Response::HTTP_OK));
    }

}
