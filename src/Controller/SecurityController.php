<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Watson;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();


        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
        ));


    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(){
        $manager=$this->getDoctrine()->getManager();
        $chats=$manager->getRepository('App:Watson')->findAll();

        foreach ($chats as $chat){
            $manager->remove($chat);
        }

        return $this->redirectToRoute('login');
    }

    /**
     * @Route("/register", name="user_registration")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            //erases the plain password

            $user->eraseCredentials();

            //gets the settings from the datbase
            $settings=$entityManager->getRepository('App:Settings')->getSettings();
            $message="El usuario \"".$user->getUsername()."\" se ha registrado";
            //sends a message to slack
            $settings->sendSlackMessage($message);

            return $this->redirectToRoute('login');
        }

        return $this->render('security/register.html.twig',[
            'form' => $form->createView(),
        ]);
    }
}
