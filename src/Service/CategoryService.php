<?php

namespace App\Service;

use App\Entity\User;
use App\Form\ProfilePictureType;
use App\Repository\UserRepository;
use App\Repository\UserVideoRepository;
use App\Repository\UserDocumentRepository;
use App\Repository\UserChecklistRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserMedDisciplineRepository;
use App\Repository\UserMedicalCourseRepository;
use App\Repository\UserSchemaContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CategoryService extends AbstractController
{
    private UserDocumentRepository $userDocRepo;
    private userRepository $userRepository;
    private UserChecklistRepository $userCheckRepo;
    private UserMedDisciplineRepository $userMedDRepo;
    private UserMedicalCourseRepository $userMedCRepo;
    private UserSchemaContentRepository $userSchemaRepo;
    private UserVideoRepository $userVideoRepo;

    public function __construct(
        UserDocumentRepository $userDocRepo,
        userRepository $userRepository,
        UserChecklistRepository $userCheckRepo,
        UserMedDisciplineRepository $userMedDRepo,
        UserMedicalCourseRepository $userMedCRepo,
        UserSchemaContentRepository $userSchemaRepo,
        UserVideoRepository $userVideoRepo
    ) {

        $this->userDocRepo = $userDocRepo;
        $this->userRepository = $userRepository;
        $this->userCheckRepo = $userCheckRepo;
        $this->userDocRepo = $userDocRepo;
        $this->userMedDRepo = $userMedDRepo;
        $this->userMedCRepo =  $userMedCRepo;
        $this->userSchemaRepo = $userSchemaRepo;
        $this->userVideoRepo = $userVideoRepo;
    }

    public function elementChecked(User $user): array
    {
        $elementsChecked = [];
        $elementsChecked['categories'] =
            $this->userRepository->findAll();
        $elementsChecked['documentChecked'] =
            $this->userDocRepo->findBy(['user' => $user, 'isChecked' => true]);
        $elementsChecked['CheckListChecked'] =
            $this->userCheckRepo->findBy(['user' => $user, 'isChecked' => true]);
        $elementsChecked['medDChecked'] =
            $this->userMedDRepo->findBy(['user' => $user, 'isChecked' => true]);
        $elementsChecked['medCChecked'] =
            $this->userMedCRepo->findBy(['user' => $user, 'isChecked' => true]);
        $elementsChecked['schemaChecked'] =
            $this->userSchemaRepo->findBy(['user' => $user, 'isChecked' => true]);
        $elementsChecked['videoChecked'] =
            $this->userVideoRepo->findBy(['user' => $user, 'isChecked' => true]);

        return $elementsChecked;
    }

    public function totalElementByUser(User $user): int
    {
        $totalDocument = $this->userDocRepo->findBy(['user' => $user]);
        $totalChecklist = $this->userCheckRepo->findBy(['user' => $user]);
        $totalMedD = $this->userMedDRepo->findBy(['user' => $user]);
        $totalMedC = $this->userMedCRepo->findBy(['user' => $user]);
        $totalSchema = $this->userSchemaRepo->findBy(['user' => $user]);
        $totalVideo = $this->userVideoRepo->findBy(['user' => $user]);

        $totalElementsByUser =
            count($totalDocument) +
            count($totalChecklist) +
            count($totalMedD) +
            count($totalMedC) +
            count($totalSchema) +
            count($totalVideo);

        return $totalElementsByUser;
    }

    public function changeProfilePicture(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(ProfilePictureType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);
        }

        return $this->renderForm('components/upload_profile_picture.html.twig', [
            'form' => $form,
        ]);
    }
}
