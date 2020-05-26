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

/**
 * Class RecipeType
 * @package App\Form
 */
class RecipeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $options;
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
            ->add('cookingTime')
            ->add('submit', SubmitType::class, [
                'label' => 'Absenden'
            ])
            ->add('cancel', SubmitType::class, [
                'label' => 'Abbrechen'
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
