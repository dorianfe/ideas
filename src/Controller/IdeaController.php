<?php

namespace App\Controller;

use App\Entity\Idea;
use App\Form\IdeaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IdeaController extends AbstractController
{
    /**
     * @Route ("/list", name="list")
     */
    public function list()
    {
        $ideaRepo = $this->getDoctrine()->getRepository(Idea::class);
        $ideas = $ideaRepo->findRecentIdeas();


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
    public function add(EntityManagerInterface $em, Request $request)
    {
        $idea = new Idea();
        //Hydrate dateCreated field automatically for example, since this is not up to the user to fill.
        $idea->setDateCreated(new \DateTime());

        $ideaform = $this->createForm(IdeaType::class, $idea);


        $ideaform->handleRequest($request);
        if ($ideaform->isSubmitted()) {
            $idea->setIsPublished(true);
            $em->persist($idea);
            $em->flush();

            $this->addFlash('success', 'Your idea was submitted');
            return $this->redirectToRoute('detail', [
                'id' => $idea->getId()
            ]);
        }

        return $this->render("idea/add.html.twig", [
            "ideaForm" => $ideaform->createView()
        ]);
    }

}