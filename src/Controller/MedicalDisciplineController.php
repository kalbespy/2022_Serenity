<?php

namespace App\Controller;

use App\Entity\MedicalDiscipline;
use App\Form\MedicalDisciplineType;
use App\Repository\CategoryRepository;
use App\Repository\MedicalDisciplineRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_ADMIN')]
#[Route('/medical/discipline')]
class MedicalDisciplineController extends AbstractController
{
    #[Route('/', name: 'app_medical_discipline_index', methods: ['GET'])]
    public function index(MedicalDisciplineRepository $medicalDRepo): Response
    {
        return $this->render('medical_discipline/index.html.twig', [
            'medical_disciplines' => $medicalDRepo->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_medical_discipline_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        MedicalDisciplineRepository $medicalDRepo,
        CategoryRepository $categoryRepo
    ): Response {
        $medicalDiscipline = new MedicalDiscipline();
        $medicalDiscipline->setCategory($categoryRepo->findOneBy(['title' => 'Anticiper ma sortie']));
        $form = $this->createForm(MedicalDisciplineType::class, $medicalDiscipline);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $medicalDRepo->save($medicalDiscipline, true);

            return $this->redirectToRoute('app_medical_discipline_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('medical_discipline/new.html.twig', [
            'medical_discipline' => $medicalDiscipline,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_medical_discipline_show', methods: ['GET'])]
    public function show(MedicalDiscipline $medicalDiscipline): Response
    {
        return $this->render('medical_discipline/show.html.twig', [
            'medical_discipline' => $medicalDiscipline,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_medical_discipline_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        MedicalDiscipline $medicalDiscipline,
        MedicalDisciplineRepository $medicalDRepo
    ): Response {
        $form = $this->createForm(MedicalDisciplineType::class, $medicalDiscipline);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $medicalDRepo->save($medicalDiscipline, true);

            return $this->redirectToRoute('app_medical_discipline_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('medical_discipline/edit.html.twig', [
            'medical_discipline' => $medicalDiscipline,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_medical_discipline_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        MedicalDiscipline $medicalDiscipline,
        MedicalDisciplineRepository $medicalDRepo
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $medicalDiscipline->getId(), $request->request->get('_token'))) {
            $medicalDRepo->remove($medicalDiscipline, true);
        }

        return $this->redirectToRoute('app_medical_discipline_index', [], Response::HTTP_SEE_OTHER);
    }
}
