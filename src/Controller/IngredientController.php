<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ingredients", name="ingredients_")
 */
class IngredientController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @return Response
     */
    public function index(Request $request): Response
    {
        $ir = $this->getDoctrine()->getRepository(Ingredient::class);

        if($request->isXmlHttpRequest()){

            $rq = $request->query->get;
            return new JsonResponse($ir->find4Ajax(
                $rq->get('sort', 'name'),
                $rq->getBoolean('sortDesc', false),
                $rq->getInt('page', 1),
                $rq->getInt('size', 1)
            ));
        }

        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ir->findAll()
        ]);
    }

    /**
     * @Route("/new", name="new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request)
    {
        // create a new ingredient
        $ingredient = new Ingredient();

        $form = $this->createForm(IngredientType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $ingredient = $form->getData();
            $em->persist($ingredient);
            $em->flush();

            return $this->redirectToRoute('ingredients_index');

        }
        return $this->render('/ingredient/new.html.twig', [
            'form' => $form->createView()
        ]);
    }


}
