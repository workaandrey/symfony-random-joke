<?php

namespace App\Controller;

use App\Service\JokeService;
use App\Service\Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, JokeService $jokeService, Mailer $mailer): Response
    {
        $categories = $jokeService->getCategories();
        $form = $this->createFormBuilder()
            ->add('email', EmailType::class)
            ->add('category', ChoiceType::class, [
                'choices' => array_combine(array_values($categories), $categories)
            ])
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $joke = $jokeService->randomJoke($data['category']);

            $mailer->send($data['email'], 'Random joke', $joke);

            $this->addFlash('success', 'Joke was successfully sent');

            return $this->redirectToRoute('home');
        }


        return $this->render('default/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
