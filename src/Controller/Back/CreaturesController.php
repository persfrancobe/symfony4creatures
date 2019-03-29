<?php

namespace App\Controller\Back;

use App\Entity\Creatures;
use App\Form\CreaturesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/creatures/")
 */
class CreaturesController extends AbstractController
{
  /***
    /**
     * @Route("/", name="creatures_index", methods={"GET"})
     */
    public function index(): Response
    {
        $creatures = $this->getDoctrine()
            ->getRepository(Creatures::class)
            ->findAll();

        return $this->render('creatures/index.html.twig', [
            'creatures' => $creatures,
        ]);
    }

    /**
     * @Route("/new", name="creatures_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $creature = new Creatures();
        $form = $this->createForm(CreaturesType::class, $creature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($creature);
            $entityManager->flush();

            return $this->redirectToRoute('creatures_index');
        }

        return $this->render('creatures/new.html.twig', [
            'creature' => $creature,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="creatures_show", methods={"GET"})
     */
    public function show(Creatures $creature): Response
    {
        return $this->render('creatures/show.html.twig', [
            'creature' => $creature,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="creatures_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Creatures $creature): Response
    {
        $form = $this->createForm(CreaturesType::class, $creature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('creatures_index', [
                'id' => $creature->getId(),
            ]);
        }

        return $this->render('creatures/edit.html.twig', [
            'creature' => $creature,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="creatures_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Creatures $creature): Response
    {
        if ($this->isCsrfTokenValid('delete'.$creature->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($creature);
            $entityManager->flush();
        }

        return $this->redirectToRoute('creatures_index');
    }
}
