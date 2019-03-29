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
     * @param Pages $page
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{id}-{slug}", name="show",methods={"GET"})
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
    public function index($type)
    {
        $pages=$this->getDoctrine()->getRepository(Pages::class)->findAll();
        return $this->render('partials/_nav.html.twig',[
            'pages'=>$pages,
        ]);
    }
}
