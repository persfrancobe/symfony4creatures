<?php

namespace App\Controller\Admin;

use App\Entity\Creatures;
use App\Form\CreaturesType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/creatures",name="app_admin_creatures_")
 * creatures crud for admin bundle
 */
class AdminCreaturesController extends AbstractController
{

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Knp\Component\Pager\PaginatorInterface   $paginator
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $creatures = $this->getDoctrine()
            ->getRepository(Creatures::class)
            ->findBy([],['dateCreation'=>'DESC']);
        //knp_paginato from kpn bundle to pagination
        $pagination=$paginator->paginate($creatures,$request->query->getInt('page', 1),3);
        return $this->render('admin/creatures/index.html.twig', [
            'creatures' => $pagination
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
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

            return $this->redirectToRoute('app_admin_creatures_index');
        }

        return $this->render('admin/creatures/new.html.twig', [
            'creature' => $creature,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Creatures $creature): Response
    {
        return $this->render('admin/creatures/show.html.twig', [
            'creature' => $creature,
        ]);
    }


    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \App\Entity\Creatures                     $creature
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Creatures $creature): Response
    {
        $form = $this->createForm(CreaturesType::class, $creature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_admin_creatures_index', [
                'id' => $creature->getId(),
            ]);
        }

        return $this->render('admin/creatures/edit.html.twig', [
            'creature' => $creature,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \App\Entity\Creatures                     $creature
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(Request $request, Creatures $creature): Response
    {
        if ($this->isCsrfTokenValid('delete'.$creature->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($creature);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_creatures_index');
    }
}
