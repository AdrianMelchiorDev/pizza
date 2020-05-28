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

        return $this->render('recipe/recipeIndex.html.twig', [
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
        return $this->render('recipeNew.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/showRecipe/{recipe}",name="showRecipe")
     * @param Recipe $recipe
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function show(Recipe $recipe, Request $request)
    {

        $rr = $this->getDoctrine()->getRepository(Recipe::class);

        if ($request->isXmlHttpRequest()) {
            return new JsonResponse($rr->findIngredients4Ajax(
                $request->query->get('sort', 'name'),
                $request->query->getBoolean('sortDesc', false),
                $request->query->getInt('page', 1),
                $request->query->getInt('size', 1),
                $recipe
            ));
        }

        return $this->render('recipeShow.html.twig', [
            'recipe'=> $recipe
        ]);
    }

    /**
     * @Route("/edit/{recipe}", name="editRecipe")
     * @param Recipe $recipe
     * @param Request $request
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
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

        return $this->render('recipeEdit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
