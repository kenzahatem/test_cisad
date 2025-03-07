<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\LoginAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, Security $security, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if (!$form->isValid()) {
                // Affichez les erreurs du formulaire
                \Symfony\Component\VarDumper\VarDumper::dump($form->getErrors(true));
            } else {
                // Récupération des données
                $plainPassword = $form->get('plainPassword')->getData();
                $email = $form->get('email')->getData();
                $username = $form->get('username')->getData();
                $role = $form->get('roles')->getData() ;

                // Traitement
                $user->setUsername($username);
                $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));
                $user->setEmail($email);
                $user->setRoles($role);

                // Persist et flush
                $entityManager->persist($user);
                $entityManager->flush();
                $this->addFlash('success', 'Registration successful! Please log in.');

                return $this->redirectToRoute('app_login');
            }
        } else {
            // Le formulaire n'est pas soumis, vous pouvez aussi afficher des erreurs
            \Symfony\Component\VarDumper\VarDumper::dump($form->getErrors(true)); // Ceci permet de voir si des erreurs apparaissent
        }


        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
