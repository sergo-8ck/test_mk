<?php


namespace AppBundle\Controller;

use AppBundle\Entity\News;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends Controller
{
    /**
     * @Route("/news/{slug}", name="news_item")
     */
    public function showAction(News $news)
    {
        return $this->render('default/show.html.twig', [
            'news' => $news,
        ]);
    }

}