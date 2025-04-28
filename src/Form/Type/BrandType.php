<?php

namespace ACSEO\SyliusBrandPlugin\Form\Type;

use ACSEO\SyliusBrandPlugin\Entity\Brand;
use ACSEO\SyliusBrandPlugin\Entity\BrandImage;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\LiveComponent\Form\Type\LiveCollectionType;

final class BrandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                ],
                'label' => 'acseo.brand.form.code',
            ])
            ->add('name', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                ],
                'label' => 'acseo.brand.form.name',
            ])
            ->add('images', LiveCollectionType::class, [
                'validation_groups' => ['sylius'],
                'entry_type' => BrandImageType::class,
                'entry_options' => [
                    'data_class' => BrandImage::class,
                    'label' => false
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => 'acseo.brand.form.images',
                'constraints' => [
                    new Assert\Valid(),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Brand::class,
        ]);
    }
}
