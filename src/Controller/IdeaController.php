<?php

namespace App\Controller;

use App\Entity\Idea;
use App\Form\IdeaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class IdeaController extends AbstractController
{
    /**
     * @Route ("/list", name="list")
     */
    public function list()
    {
        $ideaRepo = $this->getDoctrine()->getRepository(Idea::class);
        $ideas = $ideaRepo->findIdeasAndCategory();


        return $this->render("idea/list.html.twig", [
            "ideas" => $ideas
        ]);
    }

//needed to get the current user
/**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
       $this->security = $security;
    }

/**
 * @Route ("/list/{user}", name"userlist")
 */
    public function myList()
    {

        $user = $this->security->getUser();
        $ideaRepo = $this->getDoctrine->getRepository(Idea::class);
        ideas = $ideaRepo->find($user);
    }

    /**
     * @Route ("/detail/{id}", name="detail", requirements={"id": "\d+"}, methods={"GET"})
     */
    public function detail($id)
    {
        $ideaRepo = $this->getDoctrine()->getRepository(Idea::class);
        $ideas = $ideaRepo->find($id);

        if(!$ideas){
            throw $this->createNotFoundException();
        }

        return $this->render("idea/detail.html.twig", [
            "idea" => $ideas]);
    }

    /**
     * @Route ("/idea/add", name="add")
     */
    public function add(EntityManagerInterface $em, Request $request)
    {
        $this->denyAccessUnlessGranted("ROLE_USER");

        $idea = new Idea();
        //Hydrate dateCreated field automatically for example, since this is not up to the user to fill.
        $idea->setDateCreated(new \DateTime());

        $ideaform = $this->createForm(IdeaType::class, $idea);

        $ideaform->handleRequest($request);

        if ($ideaform->isSubmitted() && $ideaform->isValid()) {
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

    /**
     * @Route("/idea/delete/{id}", name="delete", requirements={"id": "\d+"})
     */
    public function delete($id, EntityManagerInterface $em)
    {
        $ideaRepo = $this->getDoctrine()->getRepository(Idea::class);
        $idea = $ideaRepo->find($id);

        $em->remove($idea);
        $em->flush();

        $this->addFlash('success', "the idea was successfully deleted");
        return $this->redirectToRoute('home');
    }
}