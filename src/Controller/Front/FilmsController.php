<?php

namespace App\Controller\Front;

use App\Entity\Films;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/films",name="app_films_")
 */
class FilmsController extends AbstractController
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(): Response
    {
        $films = $this->getDoctrine()
            ->getRepository(Films::class)->findAll();

        return $this->render("front/films/list.html.twig" ,['films' => $films]);
    }


    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{id}/{slug}", name="show", methods={"GET"},requirements={"id":"[1-9][0-9]*"})
     */
    public function show(Integer $id): Response    {
        $film=$this->getDoctrine()->getRepository(Films::class)->find($id);
        return $this->render('front/films/show.html.twig',['film' => $film,]);
    }
}
