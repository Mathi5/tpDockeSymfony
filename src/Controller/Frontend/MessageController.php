<?php

namespace App\Controller\Frontend;

use App\Entity\Message;
use App\Form\MessageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

#[Route('/', name: 'app.forum')]
class MessageController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
    }

    #[Route('', name: '.messages', methods: ['GET', 'POST'])]
    public function create(Request $request) : Response|RedirectResponse
    {
        $allMessages = $this->entityManager->getRepository(Message::class)->findBy([], ['createdAt' => 'DESC']);

        $form = $this->createForm(MessageType::class, new Message());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message = $form->getData();
            $message->setIpAddress($request->getClientIp());
            $this->entityManager->persist($message);
            $this->entityManager->flush();

            $this->addFlash('success', 'Le message a bien été créé');

            return $this->redirectToRoute('app.forum.messages');
        }

        return $this->render('Frontend/message/index.html.twig', [
            'form' => $form,
            'messages' => $allMessages
        ]);
    }


}
