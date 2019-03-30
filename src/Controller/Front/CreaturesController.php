<?php

namespace App\Controller\Front;

use App\Entity\Creatures;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/creatures",name="app_creatures_")
 */
class CreaturesController extends AbstractController
{
     /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Knp\Component\Pager\PaginatorInterface   $paginator
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="index", methods={"GET"},requirements={"id"="\d+"})
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $creatures = $this->getDoctrine()
            ->getRepository(Creatures::class)
            ->findAll();
        //knp_paginato from kpn bundle to pagination
        $pagination=$paginator->paginate($creatures,$request->query->getInt('page', 1),3);

        return $this->render('front/creatures/list.html.twig',['creatures' => $pagination]);
    }


    /**
     * @param \App\Entity\Creatures $creature
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{id}/{slug}", name="show", methods={"GET"},requirements={"id"="\d+", "slug": "[a-z][a-z0-9\-]*"})
     */
    public function show(Creatures $creature): Response
    {
        return $this->render('front/creatures/show.html.twig', [
            'creature' => $creature,
        ]);
    }


}
