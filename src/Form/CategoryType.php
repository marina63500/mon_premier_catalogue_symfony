<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label',TextType::class,[
                'label'=> "nom de la patisserie",
                'required' => true
            ])
            ->add('color',ChoiceType::class,[
                'label' => "Couleur", 
                "choices" => [
                    'Noir' => "noir",
                    "Jaune" => "jaune",
                    "rouge" => "rouge",
                    "vert" => "vert",
                    "bleu" => "bleu",
                ],
                'required' => true
            ]);
           
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
