<?php

namespace App\Controller;

use App\Entity\MedicalDiscipline;
use App\Form\MedicalDisciplineType;
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
}
