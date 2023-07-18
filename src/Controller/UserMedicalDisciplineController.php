<?php

namespace App\Controller;

use App\Entity\MedicalDiscipline;
use App\Repository\CategoryRepository;
use App\Repository\UserMedDisciplineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserMedicalDisciplineController extends AbstractController
{
    #[Route('/user/medical/discipline', name: 'app_user_medical_discipline')]
    public function index(): Response
    {
        return $this->render('user_medical_discipline/index.html.twig', [
            'controller_name' => 'UserMedicalDisciplineController',
        ]);
    }

    #[Route('/{id}/check/medical/discipline', name: 'app_medical_discipline_check')]
    public function checkMedicalDiscipline(
        MedicalDiscipline $medicalDiscipline,
        UserMedDisciplineRepository $userMedDisRepository,
        CategoryRepository $categoryRepository
    ): Response {
        /** @var \App\Entity\User */
        $user = $this->getUser();
        $userMedDiscipline = $userMedDisRepository->findOneby(
            [
                'medicalDiscipline' => $medicalDiscipline->getId(),
                'user' => $user->getId()
            ]
        );

        if ($userMedDiscipline->isIsChecked()) {
            $userMedDiscipline->setIsChecked(false);
        } else {
            $userMedDiscipline->setIsChecked(true);
        }

        $userMedDisRepository->save($userMedDiscipline, true);

        $isChecked = $userMedDiscipline->isIsChecked();

        return $this->json([
            'isChecked' => $isChecked
        ]);
    }
}
