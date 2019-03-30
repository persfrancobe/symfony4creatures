<?php
namespace App\Controller;
use App\Entity\Films;
use App\Entity\Tags;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Creatures;

/**
 * Class AjaxController
 * @package App\Controller
 * @Route("/ajax", name="ajax_")
 */
class AjaxController extends AbstractController
{

    /**
     * @param $key
     * @return null|string
     * @Route("/{key}", name="key", methods={"GET"})

    public function ajax($key){
        $resultat=$this->getDoctrine()->getRepository(Creatures::class)->findByName($key);
        if(is_iterable($resultat)){
            foreach ($resultat as $value){
                $wrds[]=$value->getNom();
            }
        }else{
            $wrds=$resultat->getNom();
        }
        return new Response($wrds,Response::HTTP_OK);
    }*/

    /**
     * @return  Response
     * @Route("/list", name="list", methods={"GET"})
     */
    public function ajaxList(){
        $list=[];
        $entity=$this->getDoctrine()->getRepository(Creatures::class)->findAll();
        foreach ($entity as $en){
            $list[]=$en->getNom();
        }        $entity=$this->getDoctrine()->getRepository(Tags::class)->findAll();
        foreach ($entity as $en){
            $list[]=$en->getNom();
        }        $entity=$this->getDoctrine()->getRepository(Films::class)->findAll();
        foreach ($entity as $en){
            $list[]=$en->getTitre();
        }
        return new Response(json_encode($list),Response::HTTP_OK);
    }
}