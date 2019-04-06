<?php
namespace App\Controller\Front;
use App\Entity\Films;
use App\Entity\Tags;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @return  Response
     * @Route("/list", name="list", methods={"GET"})
     *                  creat a list of creatures's names and films's titles and tags's names
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