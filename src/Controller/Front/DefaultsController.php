<?php

namespace App\Controller\Front;

use App\Entity\Pages;
use App\Entity\Creatures;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\SearchCreatures;

/**
 * @Route(name="app_")
 */
class DefaultsController extends AbstractController
{


    /**
     * @param \Knp\Component\Pager\PaginatorInterface   $paginator
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="homepage",methods={"GET"})
     */
    public function home(PaginatorInterface $paginator, Request $request): Response
    {
        //fin list of last creatures
        $creatures = $this->getDoctrine()
            ->getRepository(Creatures::class)
            ->findBy([],['dateCreation'=>'DESC']);
        //knp_paginato from kpn bundle to pagination
        $pagination=$paginator->paginate($creatures,$request->query->getInt('page', 1),3);

        return $this->render('front/defaults/home.html.twig',['creatures' => $pagination]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * page's list to creat nav(menu)
     */
    public function nav()
    {
        $pages=$this->getDoctrine()->getRepository(Pages::class)->findAll();
        return $this->render('partials/_nav.html.twig',[
            'pages'=>$pages,
        ]);
    }
    /**
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @param \App\Service\SearchCreatures              $searchCreatures
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/search",name="search",methods={"GET"})
     *    creat and trait search form by help of sercheCreatures Service search suject is[creatures.nom,films.titre,tags.nom]
     */
    public function search(Request $request, SearchCreatures $searchCreatures,PaginatorInterface $paginator){
        $smartkey=$request->query->get('smartkey');
        $creatures=$searchCreatures->search($smartkey);
        //knp_paginato from kpn bundle to pagination
        $pagination=$paginator->paginate($creatures,$request->query->getInt('page', 1),3);
        return $this->render('front/defaults/searchResualt.html.twig',[
            'creatures'=>$pagination,
            'motclef'=>$smartkey
        ]);

    }
}
