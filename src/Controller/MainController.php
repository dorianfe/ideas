<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * Page d'accueil
     * @Route ("/", name="home")
     */
    public function home()
    {
        return $this->render("main/home.html.twig");
    }

    /**
     * @Route ("/test", name="test")
     */
    public function test()
    {
        $ideas = ["voyage", "lecture", "jeux"];

        return $this->render("main/test.html.twig", [
            "ideas" =>$ideas,
        ]);
    }

    /**
     * @Route ("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render("main/contact-us.html.twig");
    }
}