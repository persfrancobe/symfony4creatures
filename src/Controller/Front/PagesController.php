<?php

namespace App\Controller\Front;

use App\Entity\Pages;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pages",name="app_pages_")
 */
class PagesController extends AbstractController
{

    /**
     * @param \App\Entity\Pages $page
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{id}/{slug}", name="show", methods={"GET"}, methods={"GET"},requirements={"id":"[1-9][0-9]*"}))
     */
    public function show(Pages $page): Response
    {
        return $this->render('front/pages/show.html.twig', [
            'page' => $page,
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $pages=$this->getDoctrine()->getRepository(Pages::class)->findAll();
        return $this->render('partials/_nav.html.twig',[
            'pages'=>$pages
        ]);
    }
}
