<?php

namespace App\Controller;

use App\Entity\Checklist;
use App\Repository\CategoryRepository;
use App\Repository\UserChecklistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserChecklistController extends AbstractController
{
    #[Route('/user/checklist', name: 'app_user_checklist')]
    public function index(): Response
    {
        return $this->render('user_checklist/index.html.twig', [
            'controller_name' => 'UserChecklistController',
        ]);
    }

    #[Route('/{id}/check/checklist', name: 'app_checklist_check')]
    public function checkChecklist(
        Checklist $checklist,
        UserChecklistRepository $userCheRepository,
        CategoryRepository $categoryRepository
    ): Response {
        /** @var \App\Entity\User */
        $user = $this->getUser();
        $userChecklist = $userCheRepository->findOneby(
            [
                'checklist' => $checklist->getId(),
                'user' => $user->getId()
            ]
        );

        if ($userChecklist->isIsChecked()) {
            $userChecklist->setIsChecked(false);
        } else {
            $userChecklist->setIsChecked(true);
        }
        $userCheRepository->save($userChecklist, true);

        $isChecked = $userChecklist->isIsChecked();

        return $this->json([
            'isChecked' => $isChecked
        ]);
    }
}
