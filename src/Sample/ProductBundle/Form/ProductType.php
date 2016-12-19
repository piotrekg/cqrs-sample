<?php

namespace Sample\ProductBundle\Form;

use Sample\Domain\Product\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'product.name',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'product.description',
            ])
            ->add('price', MoneyType::class, [
                'label' => 'product.price',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'admin.save',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Product::class,
            'empty_data' => function (FormInterface $interface) {
                return new Product(
                    $interface->get('name')->getData(),
                    $interface->get('price')->getData(),
                    $interface->get('description')->getData()
                );
            },
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'product_create';
    }
}
