<?php

namespace App\Controller\Front;

use App\Entity\Creatures;
use App\Service\SearchCreatures;
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
     * @param \App\Service\SearchCreatures              $searchCreatures
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/search",name="search",methods={"GET"})
     */
    public function search(Request $request, SearchCreatures $searchCreatures){
        $smartkey=$request->query->get('smartkey');
        $creatures=$searchCreatures->search($smartkey);
        return $this->render('front/pages/show.html.twig',[
            'creatures'=>$creatures,
            'page'=>['slug'=>'creatures','titre'=>'Créatures Trouvé','texte'=>count($creatures)." Resultat trouvé a Votre Recherche!"]
        ]);

    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="index", methods={"GET"},requirements={"id"="\d+"})
     */
    public function index(): Response
    {
        $creatures = $this->getDoctrine()
            ->getRepository(Creatures::class)->findBy([],['dateCreation'=>'DESC'],5);

        return $this->render('front/creatures/list.html.twig',['creatures' => $creatures]);
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
