<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class PizzaController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**
     * @Route("/pizza", name="pizza")
     */
    public function index()
    {
        return $this->render('pizza/index.html.twig', [
            'controller_name' => 'PizzaController',
        ]);
    }
}