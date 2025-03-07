<?php

namespace App\Controller;

use App\Entity\Infos;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

final class ImportCsvController extends AbstractController
{
    #[Route('/import-csv', name: 'app_import_csv')]
    public function importCsv(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        if ($request->isMethod('POST')) {
            $file = $request->files->get('csv_file');

            if (!$file) {
                $this->addFlash('error', 'Aucun fichier n\'a été sélectionné.');
                return $this->redirectToRoute('app_home');
            }

            if ($file->getClientOriginalExtension() !== 'csv') {
                $this->addFlash('error', 'Veuillez télécharger un fichier CSV valide.');
                return $this->redirectToRoute('app_home');
            }

            $csvData = file_get_contents($file->getPathname());
            $lines = explode("\n", $csvData);
            array_shift($lines); // Ignore la première ligne (en-têtes)

            $addedUsers = 0;

            foreach ($lines as $line) {
                $line = trim($line);
                if (empty($line)) {
                    continue;
                }
                $data = str_getcsv($line, ';');

                if (count($data) >= 7) {
                    $user = new User();
                    $user->setUsername($data[0]);
                    $user->setEmail($data[1]);
                    $user->setPassword($passwordHasher->hashPassword($user, $data[2]));
                    $user->setRoles([$data[3]]);
                    $entityManager->persist($user);

                    if (!empty($data[4]) || !empty($data[5]) || !empty($data[6])) {
                        $infos = new Infos();
                        $infos->setRank($data[4]);
                        $infos->setVictoire($data[5]);
                        $infos->setDefaite($data[6]);
                        $infos->setUserId($user);
                        $entityManager->persist($infos);
                    }

                    $addedUsers++;
                }
            }

            $entityManager->flush();

            if ($addedUsers > 0) {
                $this->addFlash('success', "Fichier CSV importé avec succès. $addedUsers utilisateurs ont été ajoutés.");
            } else {
                $this->addFlash('error', 'Aucun utilisateur a été ajouté.');
            }

            return $this->redirectToRoute('app_home');
        }

        return $this->render('app_home');
    }
}