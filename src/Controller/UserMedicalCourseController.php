<?php

namespace App\Controller;

use App\Entity\MedicalCourse;
use App\Repository\CategoryRepository;
use App\Repository\UserMedicalCourseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserMedicalCourseController extends AbstractController
{
    #[Route('/user/medical/course', name: 'app_user_medical_course')]
    public function index(): Response
    {
        return $this->render('user_medical_course/index.html.twig', [
            'controller_name' => 'UserMedicalCourseController',
        ]);
    }

    #[Route('/{id}/check/course', name: 'app_medicalCourse_check')]
    public function checkMedicalCourse(
        MedicalCourse $medicalCourse,
        UserMedicalCourseRepository $userCourseRepository,
        CategoryRepository $categoryRepository
    ): Response {
        /** @var \App\Entity\User */
        $user = $this->getUser();
        $userMedicalCourse = $userCourseRepository->findOneby(
            [
                'medicalCourse' => $medicalCourse->getId(),
                'user' => $user->getId()
            ]
        );
        if ($userMedicalCourse->isIsChecked()) {
            $userMedicalCourse->setIsChecked(false);
        } else {
            $userMedicalCourse->setIsChecked(true);
        }

        $userCourseRepository->save($userMedicalCourse, true);

        $isChecked = $userMedicalCourse->isIsChecked();

        return $this->json([
            'isChecked' => $isChecked
        ]);
    }
}
