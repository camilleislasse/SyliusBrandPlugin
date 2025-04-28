<?php

namespace ACSEO\SyliusBrandPlugin\Grid;

use Sylius\Bundle\GridBundle\Builder\Action\CreateAction;
use Sylius\Bundle\GridBundle\Builder\Action\DeleteAction;
use Sylius\Bundle\GridBundle\Builder\Action\UpdateAction;
use Sylius\Bundle\GridBundle\Builder\Action\GenericAction;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\ItemActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\MainActionGroup;
use Sylius\Bundle\GridBundle\Builder\Field\StringField;
use Sylius\Bundle\GridBundle\Builder\Field\TwigField;
use Sylius\Bundle\GridBundle\Builder\Filter\StringFilter;
use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
use Sylius\Bundle\GridBundle\Grid\ResourceAwareGridInterface;
use ACSEO\SyliusBrandPlugin\Entity\Brand;

final class BrandGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public static function getName(): string
    {
        return 'acseo_sylius_brand_admin_brand';
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            ->addField(
                TwigField::create('images', '@ACSEOSyliusBrandPlugin/Grid/Field/image.html.twig')
                    ->setLabel('acseo.brand.ui.image')
            )
            ->addField(
                StringField::create('name')
                    ->setLabel('acseo.brand.ui.name')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('code')
                    ->setLabel('acseo.brand.ui.code')
                    ->setSortable(true)
            )
            ->addFilter(
                StringFilter::create('search')
                    ->setOptions(['fields' => ['code', 'name']])
            )
            ->addActionGroup(
                MainActionGroup::create(
                    CreateAction::create()
                )
            )
            ->addActionGroup(
                ItemActionGroup::create(
                    UpdateAction::create(),
                    DeleteAction::create()
                )
            )
        ;
    }

    public function getResourceClass(): string
    {
        return Brand::class;
    }
}
