<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Category;
use App\Form\CategoryType;
use App\Entity\UserDocument;
use App\Form\ProfilePictureType;
use App\Service\CategoryService;
use App\Entity\UserMedicalCourse;
use App\Repository\UserRepository;
use App\Repository\CategoryRepository;
use App\Repository\UserVideoRepository;
use App\Repository\UserDocumentRepository;
use App\Repository\UserChecklistRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\UserMedDisciplineRepository;
use App\Repository\UserMedicalCourseRepository;
use App\Repository\UserSchemaContentRepository;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_USER')]
#[Route('/category')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'app_category_index', methods: ['GET', 'POST'])]
    public function index(
        Request $request,
        CategoryRepository $categoryRepository,
        CategoryService $categoryService,
        UserRepository $userRepository
    ): Response {
        /** @var \App\Entity\User */
        $user = $this->getUser();
        $elementsChecked = $categoryService->elementChecked($user);
        $categories = $categoryRepository->findAll();

        $form = $this->createForm(ProfilePictureType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('category/index.html.twig', [
            'categories' => $categories,
            'document' => $elementsChecked['documentChecked'],
            'checklist' => $elementsChecked['CheckListChecked'],
            'medicalD' => $elementsChecked['medDChecked'],
            'medicalC' => $elementsChecked['medCChecked'],
            'schema' => $elementsChecked['schemaChecked'],
            'video' => $elementsChecked['videoChecked'],
            'form' => $form
        ]);
    }

    #[Route('/new', name: 'app_category_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CategoryRepository $categoryRepository): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoryRepository->save($category, true);

            return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('category/new.html.twig', [
            'category' => $category,
            'form' => $form
        ]);
    }

    #[Route('/{title}', name: 'app_category_show', methods: ['GET'])]
    public function show(
        Category $category,
        UserDocumentRepository $userDocRepository,
        UserSchemaContentRepository $userSchemaRepository,
        UserChecklistRepository $userCheckRepository,
        UserVideoRepository $userVideoRepository,
        UserMedicalCourseRepository $userCourseRepository,
        UserMedDisciplineRepository $userDiscRepository,
        CategoryService $categoryService
    ): Response {


        /** @var \App\Entity\User */
        $user = $this->getUser();
        $userDocuments = $userDocRepository->findDocumentByUser($user->getId());
        $userSchemas = $userSchemaRepository->findSchemaByUser($user->getId());
        $userVideos = $userVideoRepository->findVideoByUser($user->getId());
        $userMedicalCourses = $userCourseRepository->findMedicalCourseByUser($user->getId());
        $userMedDisciplines = $userDiscRepository->findMedicalDisciplineByUser($user->getId());
        $userChecklists = $userCheckRepository->findChecklistByUser($user->getId());

        $elementsChecked = $categoryService->elementChecked($user);


        return $this->render('category/show.html.twig', [
            'category' => $category,
            'userDocuments' => $userDocuments,
            'userChecklists' => $userChecklists,
            'userSchemas' => $userSchemas,
            'userVideos' => $userVideos,
            'userMedicalCourses' => $userMedicalCourses,
            'userMedicalDisciplines' => $userMedDisciplines,
            'categories' => $elementsChecked['categories'],
            'document' => $elementsChecked['documentChecked'],
            'checklist' => $elementsChecked['CheckListChecked'],
            'medicalD' => $elementsChecked['medDChecked'],
            'medicalC' => $elementsChecked['medCChecked'],
            'schema' => $elementsChecked['schemaChecked'],
            'video' => $elementsChecked['videoChecked']
        ]);
    }

    #[Route('/{id}/edit', name: 'app_category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Category $category, CategoryRepository $categoryRepository): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoryRepository->save($category, true);

            return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('category/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_category_delete', methods: ['POST'])]
    public function delete(Request $request, Category $category, CategoryRepository $categoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $category->getId(), $request->request->get('_token'))) {
            $categoryRepository->remove($category, true);
        }

        return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
    }
}
