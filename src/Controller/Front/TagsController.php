<?php

namespace App\Controller\Front;

use App\Entity\Tags;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TagsController
 * @package App\Controller\Front
 * @Route("/tags", name="app_tags_")
 */
class TagsController extends AbstractController
{
    /**
     * @param Tags $tag
     * @return Response
     * @Route("/{id}/{slug}", name="show", methods={"GET"},requirements={"id":"[1-9][0-9]*", "slug": "[a-z][a-z0-9\-]*"})
     */
    public function show(Tags $tag): Response
    {
        return $this->render('front/tags/show.html.twig', [
            'tag' => $tag,
        ]);
    }

    /**
     * @return Response
     */
    public function list(): Response
    {
        $tags = $this->getDoctrine()
            ->getRepository(Tags::class)
            ->findAll();

        return $this->render('front/tags/_list.html.twig', [
            'tags' => $tags,
        ]);
    }
}
