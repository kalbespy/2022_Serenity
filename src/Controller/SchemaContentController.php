<?php

namespace App\Controller;

use App\Entity\SchemaContent;
use App\Form\SchemaContentType;
use App\Repository\CategoryRepository;
use App\Repository\SchemaContentRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_ADMIN')]
#[Route('/schema/content')]
class SchemaContentController extends AbstractController
{
    #[Route('/', name: 'app_schema_content_index', methods: ['GET'])]
    public function index(SchemaContentRepository $schemaContentRepo): Response
    {
        return $this->render('schema_content/index.html.twig', [
            'schema_contents' => $schemaContentRepo->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_schema_content_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        SchemaContentRepository $schemaContentRepo,
        CategoryRepository $categoryRepository
    ): Response {
        $schemaContent = new SchemaContent();
        $schemaContent->setCategory($categoryRepository->findOneBy(['title' => 'Comprendre mon opération']));

        $form = $this->createForm(SchemaContentType::class, $schemaContent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $schemaContentRepo->save($schemaContent, true);

            return $this->redirectToRoute('app_schema_content_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('schema_content/new.html.twig', [
            'schema_content' => $schemaContent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_schema_content_show', methods: ['GET'])]
    public function show(SchemaContent $schemaContent): Response
    {
        return $this->render('schema_content/show.html.twig', [
            'schema_content' => $schemaContent,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_schema_content_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        SchemaContent $schemaContent,
        SchemaContentRepository $schemaContentRepo
    ): Response {
        $form = $this->createForm(SchemaContentType::class, $schemaContent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $schemaContentRepo->save($schemaContent, true);

            return $this->redirectToRoute('app_schema_content_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('schema_content/edit.html.twig', [
            'schema_content' => $schemaContent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_schema_content_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        SchemaContent $schemaContent,
        SchemaContentRepository $schemaContentRepo
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $schemaContent->getId(), $request->request->get('_token'))) {
            $schemaContentRepo->remove($schemaContent, true);
        }

        return $this->redirectToRoute('app_schema_content_index', [], Response::HTTP_SEE_OTHER);
    }
}
