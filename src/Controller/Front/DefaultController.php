<?php

namespace App\Controller\Front;

use App\Entity\Pages;
use App\Entity\Creatures;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(name="app_")
 */
class DefaultController extends AbstractController
{


    /**
     * @param \Knp\Component\Pager\PaginatorInterface   $paginator
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="homepage",methods={"GET"})
     */
    public function home(PaginatorInterface $paginator, Request $request): Response
    {
        $creatures = $this->getDoctrine()
            ->getRepository(Creatures::class)
            ->findBy([],['dateCreation'=>'DESC']);
        $pagination=$paginator->paginate($creatures,$request->query->getInt('page', 1),3);

        return $this->render('front/default/home.html.twig',['creatures' => $pagination]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function nav()
    {
        $pages=$this->getDoctrine()->getRepository(Pages::class)->findAll();
        return $this->render('partials/_nav.html.twig',[
            'pages'=>$pages,
        ]);
    }
}
