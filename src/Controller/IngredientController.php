<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class IngredientController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**
     * @Route("/ingredient", name="ingredient")
     */
    public function index()
    {
        return $this->render('ingredient/index.html.twig', [
            'controller_name' => 'IngredientController',
        ]);
    }
}