<?php


namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends Controller
{
    /**
     * @Route("/news", name="news_list")
     */
    public function indexAction()
    {
        die('indexAction');
    }

    /**
     * @Route("/news/{slug}", name="news_item")
     */
    public function showAction($slug)
    {
        die($slug);
    }

}