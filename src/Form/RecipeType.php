<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Entity\Recipe;
use App\Repository\IngredientRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name'
            ])
            ->add('ingredients', EntityType::class, [
                'label' => 'Zutaten für das Rezept',
                'class' => Ingredient::class,
                'multiple' => true,
                'query_builder' => static function (IngredientRepository $ir) {
                    return $ir->createQueryBuilder('i')
//                        ->where()
                        ->orderBy('i.name');
                },
                'mapped' => false

            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Absenden'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
