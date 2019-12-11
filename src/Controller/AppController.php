<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{

    /**
     * @Route("/", name="homepage")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('users_list');
        }
        return $this->render('index.html.twig');
    }

}