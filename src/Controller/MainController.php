<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Idea;
use App\Form\IdeaType;
use Doctrine\ORM\EntityManagerInterface;

class MainController extends AbstractController
{
    /**
     * Homepage
     * @Route ("/", name="home")
     */
    public function home()
    {
       $ideaRepo = $this->getDoctrine()->getRepository(Idea::class);  
      $ideas = $ideaRepo->findBy([], ["id" => "DESC"], 1, 0);
      

       return $this->render("main/home.html.twig", [
            "idea" => $ideas
        ]);
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