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

        if ($request->isXmlHttpRequest()) {
            return new JsonResponse($rr->find4Ajax(
                $request->query->get('sort', 'name'),
                $request->query->getBoolean('sortDesc', false),
                $request->query->getInt('page', 1),
                $request->query->getInt('size', 1)
            ));
        }

        return $this->render('recipe/index.html.twig', [
            'recipes' => $rr->findAll()
        ]);
    }


    /**
     * @Route("/new", name="newRecipe")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        // create a new recipe
        $recipe = new Recipe();

        $form = $this->createForm(RecipeType::class);
        $form->handleRequest($request);

        if ($request->request->has('cancel')) {
            return $this->redirectToRoute('recipe_index');
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $recipe = $form->getData();
//dd('asd');
            $em->persist($recipe);
            $em->flush();

            return $this->redirectToRoute('recipe_index');
        }
        return $this->render('recipe/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Recipe $recipe
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @param Request $request
     */
    public function edit(Recipe $recipe, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($request->request->has('cancel')) {
            return $this->redirectToRoute('recipe_index');
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($recipe);
            $em->flush();

            return $this->redirectToRoute('recipe_index');
        }

        return $this->render('recipe/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
