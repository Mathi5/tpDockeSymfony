<?php

namespace App\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/flag', name: 'app.backend')]
class FlagController extends AbstractController
{
    #[Route('', name: '.flag')]
    public function index(): Response
    {
        $user = $this->getUser();

        if ($user->getRoles()[0] !== 'ROLE_ADMIN' && $user->getFlag() == null && $user->getFlag() == '') {
            return $this->redirectToRoute('');
        }

        return $this->render('backend/flag/index.html.twig', [
            'flag' => $user->getFlag(),
        ]);
    }
}
