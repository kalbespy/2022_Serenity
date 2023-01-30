<?php

namespace App\Controller;

use App\Entity\MedicalCourse;
use App\Form\MedicalCourseType;
use App\Repository\CategoryRepository;
use App\Repository\MedicalCourseRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_ADMIN')]
#[Route('/medical/course')]
class MedicalCourseController extends AbstractController
{
    #[Route('/', name: 'app_medical_course_index', methods: ['GET'])]
    public function index(MedicalCourseRepository $medicalCourseRepo): Response
    {
        return $this->render('medical_course/index.html.twig', [
            'medical_courses' => $medicalCourseRepo->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_medical_course_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        MedicalCourseRepository $medicalCourseRepo,
        CategoryRepository $categoryRepo
    ): Response {
        $medicalCourse = new MedicalCourse();
        $medicalCourse->setCategory($categoryRepo->findOneBy(['title' => 'Préparer mon arrivée en toute sérénité']));
        $form = $this->createForm(MedicalCourseType::class, $medicalCourse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $medicalCourseRepo->save($medicalCourse, true);

            return $this->redirectToRoute('app_medical_course_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('medical_course/new.html.twig', [
            'medical_course' => $medicalCourse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_medical_course_show', methods: ['GET'])]
    public function show(MedicalCourse $medicalCourse): Response
    {
        return $this->render('medical_course/show.html.twig', [
            'medical_course' => $medicalCourse,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_medical_course_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        MedicalCourse $medicalCourse,
        MedicalCourseRepository $medicalCourseRepo
    ): Response {
        $form = $this->createForm(MedicalCourseType::class, $medicalCourse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $medicalCourseRepo->save($medicalCourse, true);

            return $this->redirectToRoute('app_medical_course_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('medical_course/edit.html.twig', [
            'medical_course' => $medicalCourse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_medical_course_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        MedicalCourse $medicalCourse,
        MedicalCourseRepository $medicalCourseRepo
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $medicalCourse->getId(), $request->request->get('_token'))) {
            $medicalCourseRepo->remove($medicalCourse, true);
        }

        return $this->redirectToRoute('app_medical_course_index', [], Response::HTTP_SEE_OTHER);
    }
}
