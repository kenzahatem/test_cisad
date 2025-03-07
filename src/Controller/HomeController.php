<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\SecurityBundle\Security;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Security $security): Response
    {
        // Récupérer l'utilisateur connecté
        $user = $security->getUser();

        // Vérifier si l'utilisateur est connecté
        if ($user) {
            $username = $user->getUsername();
            $message = "Bonjour $username, vous êtes bien connecté !";
        } else {
            $message = "Vous n'êtes pas connecté.";
        }

        return $this->render('home/index.html.twig', [
            'message' => $message,
        ]);
    }
}
