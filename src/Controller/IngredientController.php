<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class IngredientController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**
     * @Route("/ingredients", name="ingredients")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('ingredient/index.html.twig', [
            'controller_name' => 'IngredientController',
        ]);
    }
}
