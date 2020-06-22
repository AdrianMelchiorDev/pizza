<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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

        if ($request->isXmlHttpRequest()) {
            return new JsonResponse($ir->find4Ajax(
                $request->query->get('sort', 'name'),
                $request->query->getBoolean('sortDesc', false),
                $request->query->getInt('page', 1),
                $request->query->getInt('size', 1)
            ));
        }

        return $this->render('ingredient/ingredientIndex.html.twig', [
            'ingredients' => $ir->findAll()
        ]);
    }

    /**
     * @Route("/new", name="new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        // create a new ingredient
        $ingredient = new Ingredient();

        $form = $this->createForm(IngredientType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $ingredient = $form->getData();
            $em->persist($ingredient);
            $em->flush();

            return $this->redirectToRoute('ingredients_index');
        }
        return $this->render('ingredientNew.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
