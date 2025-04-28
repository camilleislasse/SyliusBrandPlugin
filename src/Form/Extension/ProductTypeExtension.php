<?php

declare(strict_types=1);

namespace ACSEO\SyliusBrandPlugin\Form\Extension;

use ACSEO\SyliusBrandPlugin\Form\Type\BrandAutocompleteType;
use Sylius\Bundle\AdminBundle\Form\Type\ProductType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

final class ProductTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('brand', BrandAutocompleteType::class, [
                'multiple' => false,
                'label' => 'acseo.brand.ui.brand',
            ]);
    }

    public static function getExtendedTypes(): iterable
    {
        return [ProductType::class];
    }
}
