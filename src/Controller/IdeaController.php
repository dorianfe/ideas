<?php

namespace App\Controller;

use App\Entity\Idea;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IdeaController extends AbstractController
{
    /**
     * @Route ("/list", name="list")
     */
    public function list()
    {
        $ideaRepo = $this->getDoctrine()->getRepository(Idea::class);
        $ideas = $ideaRepo->findRecentIdea();


        return $this->render("idea/list.html.twig", [
            "ideas" => $ideas
        ]);
    }

    /**
     * @Route ("/detail/{id}", name="detail", requirements={"id": "\d+"}, methods={"GET"})
     */
    public function detail($id)
    {
        $ideaRepo = $this->getDoctrine()->getRepository(Idea::class);
        $ideas = $ideaRepo->find($id);

        return $this->render("idea/detail.html.twig", [
            "idea" => $ideas]);
    }

    /**
     * @Route ("/idea/add", name="add")
     */
    public function add(EntityManagerInterface $em)
    {
        $idea = new Idea();
        $idea->setAuthor("Dodo");
        $idea->setDescription("Try got get a job if possible as a developer. Websites could be a good start.");
        $idea->setTitle("Find a job.");
        $idea->setDateCreated(new \DateTime());
        $idea->setIsPublished(true);

        $em->persist($idea);
        $em->flush();

        return $this->render("idea/add");
    }

}