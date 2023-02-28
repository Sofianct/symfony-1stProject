<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserController extends AbstractController
{

    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, ManagerRegistry $doctrine): Response
    {
        //CREAR EL FORMULARIO
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        //VINCULAR EL FORMULARIO CON EL OBJETO
        $form->handleRequest($request);

        //COMPROBAR SI SE ENVIÓ EL FORMULARIO
        if ($form->isSubmitted() && $form->isValid()) {

            //MODIFICANDO EL OBJETO PARA GUARDARLO
            $user->setRole('ROLE_USER');
            $user->setCreatedAt(new \DateTime('now'));

            //CIFRAR LA CONTRASEÑA
            $passwordHasher = $passwordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($passwordHasher);

            //GUARDAR EL USUARIO
            $em = $doctrine->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('tasks');
        }

        return $this->render('user/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
