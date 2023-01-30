<?php

namespace App\Controller;

use App\Entity\Checklist;
use App\Form\ChecklistType;
use App\Repository\CategoryRepository;
use App\Repository\ChecklistRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_ADMIN')]
#[Route('/checklist')]
class ChecklistController extends AbstractController
{
    #[Route('/', name: 'app_checklist_index', methods: ['GET'])]
    public function index(ChecklistRepository $checklistRepository): Response
    {
        return $this->render('checklist/index.html.twig', [
            'checklists' => $checklistRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_checklist_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        ChecklistRepository $checklistRepository,
        CategoryRepository $categoryRepository
    ): Response {
        $checklist = new Checklist();
        $checklist->setCategory($categoryRepository
            ->findOneBy(['title' => 'Ma check-list avant le départ à la clinique']));
        $form = $this->createForm(ChecklistType::class, $checklist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $checklistRepository->save($checklist, true);

            return $this->redirectToRoute('app_checklist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('checklist/new.html.twig', [
            'checklist' => $checklist,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_checklist_show', methods: ['GET'])]
    public function show(Checklist $checklist): Response
    {
        return $this->render('checklist/show.html.twig', [
            'checklist' => $checklist,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_checklist_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Checklist $checklist, ChecklistRepository $checklistRepository): Response
    {
        $form = $this->createForm(ChecklistType::class, $checklist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $checklistRepository->save($checklist, true);

            return $this->redirectToRoute('app_checklist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('checklist/edit.html.twig', [
            'checklist' => $checklist,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_checklist_delete', methods: ['POST'])]
    public function delete(Request $request, Checklist $checklist, ChecklistRepository $checklistRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $checklist->getId(), $request->request->get('_token'))) {
            $checklistRepository->remove($checklist, true);
        }

        return $this->redirectToRoute('app_checklist_index', [], Response::HTTP_SEE_OTHER);
    }
}
