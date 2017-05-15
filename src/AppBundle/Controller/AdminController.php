<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends Controller
{

    /**
     * @Route("/dashboard")
     */
    public function indexAction()
    {

        return $this->render('AppBundle:Admin:index.html.twig');
    }



}
