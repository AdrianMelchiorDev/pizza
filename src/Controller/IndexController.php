<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class IndexController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**
     * @Route("/", name="index")
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingReturnTypeHint
     */
    public function index()
    {
        return $this->render('index/indexIndex.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
