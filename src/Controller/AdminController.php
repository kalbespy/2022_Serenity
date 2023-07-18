<?php

namespace App\Controller;

use App\Repository\WelfareRepository;
use DateTimeImmutable;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin', name: 'app_admin')]
    public function index(WelfareRepository $welfareRepository): Response
    {
        $today = new DateTimeImmutable();

        return $this->render('admin/index.html.twig', [
            'welfares' => $welfareRepository->findBy(['responseAt' => $today]),

        ]);
    }
}
