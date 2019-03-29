<?php

namespace App\Controller\Front;

use App\Entity\Films;
use Knp\Component\Pager\PaginatorInterface;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/films",name="app_films_")
 */
class FilmsController extends AbstractController
{


    /**
     * @param \Knp\Component\Pager\PaginatorInterface   $paginator
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $films = $this->getDoctrine()
            ->getRepository(Films::class)->findAllMe();
        $films=$paginator->paginate($films,$request->query->getInt('page', 1),3);

        return $this->render("front/films/list.html.twig" ,['films' => $films]);
    }


    /**
     * @param \App\Entity\Films
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{id}/{slug}", name="show", methods={"GET"},requirements={"id":"[1-9][0-9]*"})
     */
    public function show(Films $film): Response    {
        return $this->render("front/films/show.html.twig" , ['film' => $film,]);
    }
}
