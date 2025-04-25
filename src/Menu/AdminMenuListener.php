<?php

declare(strict_types=1);

namespace ACSEO\SyliusBrandPlugin\Menu;

use Knp\Menu\ItemInterface;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: 'sylius.menu.admin.main', method: 'addAdminMenuItems')]
final class AdminMenuListener
{
    public function addAdminMenuItems(MenuBuilderEvent $event): void
    {

        $menu = $event->getMenu();
        $catalog = $menu->getChild('catalog');

        if ($catalog) {
            $this->addChild($catalog);
        } else {
            $this->addChild($menu->getFirstChild());
        }
    }

    private function addChild(ItemInterface $item): void
    {
        $item
            ->addChild('brands', [
                'route' => 'acseo_sylius_brand_admin_brand_index',
            ])
            ->setLabel('acseo_sylius_brand.ui.brands')
            ->setLabelAttribute('icon', 'building');
    }
}
