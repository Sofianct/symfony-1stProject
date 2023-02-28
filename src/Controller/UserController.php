<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderValidator;

class UserController extends AbstractController
{
    public function register(Request $request, UserPasswordEncoderValidator $encoder)
    {
        //Crear el formulario
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        //Rellenar el objeto con los datos del form
        $form->handleRequest($request);

        //Comprobar si el form se ha enviado
        if ($form->isSubmitted()) {
            //Modificando el objeto para guardarlo
            $user->setRole('ROLE_USER');
            //Cifrar contraseña
            $encoded = $encoder->encodePassword($user, $user->getpassword());
            $user->setpassword($encoded);
        }

        return $this->render('user/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
