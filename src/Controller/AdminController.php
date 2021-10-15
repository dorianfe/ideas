<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("", name="admin_home")
     */
    public function home(): Response
    {
        /*return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);*/

        return new Response("test home backoffice access");
    }

    /**
     * @Route("/test", name="admin_test")
     */
    public function test(): Response
    {
        /*return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);*/

        return new Response("test TestPage backoffice access");
    }
}
