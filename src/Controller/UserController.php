<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class UserController extends AbstractFOSRestController
{
    /**
     * Lists all Users.
     * @Rest\Get("/users")
     *
     * @return Response
     */
    public function getUsersAction(): Response
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->findall();
        return $this->handleView($this->view($users));
    }

    /**
     * Retrieves a User resource
     * @Rest\Get("/users/{userId}")
     *
     * @return Response
     */
    public function getUserAction(int $userId): Response
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->findById($userId);
        // In case our GET was a success we need to return a 200 HTTP OK response with the request object
        if($user) {
            return $this->handleView($this->view($user, Response::HTTP_OK));
        }

        return $this->handleView($this->view(['error' => 'User not found'], Response::HTTP_NOT_FOUND));
    }


    /**
     * Create a user
     *
     * @Rest\Post("/users")
     *
     * @return Response
     */
    public function postUserAction(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($user);
            $doctrine->flush();


// In case our POST was a success we need to return a 201 HTTP CREATED response
            return $this->handleView($this->view($user, Response::HTTP_CREATED));
        }
        return $this->handleView($this->view($form->getErrors()));
    }


    /**
     * Edit User resource
     * @Rest\Put("/users/{id}")
     *
     * @return Response
     */
    public function editUserAction(Request $request, int $id): Response
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        if(!$user) {
            return $this->handleView($this->view(['error' => 'User not found'], Response::HTTP_NOT_FOUND));
        }

        $form = $this->createForm(UserType::class, $user);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {

            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->merge($user);
            $doctrine->flush();
            return $this->handleView($this->view($user, Response::HTTP_OK));
        } else {
            return $this->handleView($this->view($form->getErrors()));
        }
    }

    /**
     * Removes the User resource
     * @Rest\Delete("/users/{id}")
     *
     * @return Response
     */
    public function deleteUserAction(User $user): Response
    {
        $doctrine = $this->getDoctrine()->getManager();
        $doctrine->remove($user);
        $doctrine->flush();

        return $this->handleView($this->view(["msg" => "User removed with success"], Response::HTTP_OK));
    }

}
