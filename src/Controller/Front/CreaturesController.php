<?php

namespace App\Controller\Front;

use App\Entity\Creatures;
use App\Service\SearchCreatures;
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
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @param \App\Service\SearchCreatures              $searchCreatures
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/search",name="search",methods={"GET"})
     */
    public function search(Request $request, SearchCreatures $searchCreatures,PaginatorInterface $paginator){
        $smartkey=$request->query->get('smartkey');
        $creatures=$searchCreatures->search($smartkey);
        $pagination=$paginator->paginate($creatures,$request->query->getInt('page', 1),3);
        return $this->render('front/pages/show.html.twig',[
            'creatures'=>$pagination,
            'page'=>['slug'=>'les creatures','titre'=>'Créatures Trouvé','texte'=>" Resultat trouvé a Votre Recherche!"]
        ]);

    }


    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Knp\Component\Pager\PaginatorInterface   $paginator
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="index", methods={"GET"},requirements={"id"="\d+"})
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $creatures = $this->getDoctrine()
            ->getRepository(Creatures::class)->findBy([],['dateCreation'=>'DESC'],5);
        $pagination=$paginator->paginate($creatures,$request->query->getInt('page', 1),3);

        return $this->render('front/creatures/list.html.twig',['creatures' => $pagination]);
    }


    /**
     * @param \App\Entity\Creatures $creature
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{id}/{slug}", name="show", methods={"GET"},requirements={"id"="\d+"})
     */
    public function show(Creatures $creature): Response
    {
        return $this->render('front/creatures/show.html.twig', [
            'creature' => $creature,
        ]);
    }


}
