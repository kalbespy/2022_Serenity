<?php

namespace App\Controller;

use App\Repository\WelfareRepository;
use DateTime;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('login/index.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername
        ]);
    }

    #[Route('/logout', name: 'app_logout', methods: ['GET'])]
    public function logout(): void
    {
    }

    #[Route('/login/redirect', name: 'app_login_redirect')]
    #[IsGranted('ROLE_USER')]
    public function redirectAfterLogin(WelfareRepository $welfareRepository): Response
    {
        if (in_array('ROLE_ADMIN', $this->getUser()->getRoles())) {
            return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
        }

        if ($this->isGranted('ROLE_USER')) {
            /** @var \App\Entity\User */
            $user = $this->getUser();
            $date = new DateTime();

            $todayWelfare = $welfareRepository->findWelfareByUserByDate($user->getId(), $date->format('Y-m-d'));

            if ($todayWelfare) {
                return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
            } else {
                return $this->redirectToRoute('app_welfare', [], Response::HTTP_SEE_OTHER);
            };
        }
        return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
    }
}
