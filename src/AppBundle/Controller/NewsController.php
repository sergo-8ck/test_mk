<?php


namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends Controller
{
    /**
     * @Route("/news/{slug}", name="news_item")
     */
    public function showAction($slug)
    {
        $news = $this->getDoctrine()
                     ->getRepository('AppBundle:News')
                     ->findOneBy(array('slug' => $slug));

        return $this->render('default/show.html.twig', [
            'news' => $news,
        ]);
    }

}