<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Sylius Sp. z o.o.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ACSEO\SyliusBrandPlugin\Form\Type;

use ACSEO\SyliusBrandPlugin\Entity\Brand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\BaseEntityAutocompleteType;

#[AsEntityAutocompleteField(
    alias: 'sylius_admin_brand',
    route: 'sylius_admin_entity_autocomplete',
)]
final class BrandAutocompleteType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'class' => Brand::class,
            'choice_label' => 'code',
            'choice_value' => 'code',
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'sylius_admin_brand_autocomplete';
    }

    public function getParent(): string
    {
        return BaseEntityAutocompleteType::class;
    }
}
