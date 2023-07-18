<?php

namespace App\Controller;

use App\Entity\Welfare;
use App\Form\WelfareType;
use App\Repository\WelfareRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_USER')]
class WelfareController extends AbstractController
{
    #[Route('/welfare', name: 'app_welfare')]
    public function index(
        Request $request,
        WelfareRepository $welfareRepository,
    ): Response {
        $welfare = new Welfare();
        $welfareform = $this->createForm(WelfareType::class, $welfare);

        $user = $this->getUser();
        $welfareform->handleRequest($request);

        if ($welfareform->isSubmitted() && $welfareform->isValid()) {
            /** @var \App\Entity\User $user */
            $welfare->setUser($user);
            $welfareRepository->save($welfare, true);

            match ($welfare->getScore()) {
                1 => $this->addFlash(
                    'info',
                    "Merci pour votre réponse"
                ),
                2, 3, 4 => $this->addFlash(
                    'info',
                    "Merci pour votre réponse. Nous vous contacterons dans les plus brefs délais."
                ),
                default => $this->addFlash(
                    'info',
                    "Merci pour votre réponse."
                )
            };
            return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('welfare/index.html.twig', [
            'form' => $welfareform->createView(),

        ]);
    }

    #[Route('/{id}/welfare/isCallBack', name: 'app_welfare_isCallBack')]
    public function callBack(
        Welfare $welfare,
        WelfareRepository $welfareRepository
    ): Response {
        $callBack = $welfareRepository->findOneBy(
            [
                'id' => $welfare->getId(),
            ]
        );

        if ($callBack->isIsCallBack()) {
            $callBack->setIsCallBack(false);
        } else {
            $callBack->setIsCallBack(true);
        }

        $welfareRepository->save($callBack, true);

        return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
    }
}
