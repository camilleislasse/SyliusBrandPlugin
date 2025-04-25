<?php

declare(strict_types=1);

namespace ACSEO\SyliusBrandPlugin\Menu;

use Sylius\Bundle\AdminBundle\Event\ProductMenuBuilderEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: 'sylius.menu.admin.product.form', method: 'addItems')]
final class AdminProductFormMenuListener
{
    public function addItems(ProductMenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        $menu
            ->addChild('brand')
            ->setAttribute('template', '@ACSEOSyliusBrandPlugin/Admin/Product/_brand.html.twig')
            ->setLabel('acseo_sylius_brand.ui.brand')
        ;
    }
}
