<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/recipe", name="recipe_")
 */
class RecipeController extends AbstractController
{

    /**
     * @Route("/", name="index")
     * @return Response
     */
    public function index(Request $request): Response
    {
        $rr = $this->getDoctrine()->getRepository(Recipe::class);

        if($request->isXmlHttpRequest()){

            $rq = $request->query->get;
            return new JsonResponse($rr->find4Ajax(
                $rq->get('sort', 'name'),
                $rq->getBoolean('sortDesc', false),
                $rq->getInt('page', 1),
                $rq->getInt('size', 1)
            ));
        }

        return $this->render('recipe/index.html.twig',[
            'recipes' => $rr->findAll()
        ]);
    }


    /**
     * @Route("/new", name="new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request)
    {
        // create a new recipe
        $recipe = new Recipe();

        $form = $this->createForm(RecipeType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $recipe = $form->getData();
            dd($form);

            $em->persist($recipe);
            $em->flush();

            return $this->redirectToRoute('recipe_index');

        }
        return $this->render('recipe/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
