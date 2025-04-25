<?php

declare(strict_types=1);

namespace ACSEO\SyliusBrandPlugin\Menu;


use Knp\Menu\FactoryInterface;
use Loevgaard\SyliusBrandPlugin\Event\BrandMenuBuilderEvent;
use Loevgaard\SyliusBrandPlugin\Model\BrandInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class BrandFormMenuBuilder
{
    public const EVENT_NAME = 'loevgaard_sylius_brand.menu.admin.brand.form';

    public function __construct(
        private readonly FactoryInterface $factory,
        private readonly EventDispatcherInterface $eventDispatcher)
    {
    }

    public function createMenu(array $options = []): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        if (!array_key_exists('brand', $options) || !$options['brand'] instanceof BrandInterface) {
            return $menu;
        }

        $menu
            ->addChild('details')
            ->setAttribute('template', '@ACSEOSyliusBrandPlugin/Admin/Brand/Tab/_details.html.twig')
            ->setLabel('sylius.ui.details')
            ->setCurrent(true)
        ;

        $menu
            ->addChild('media')
            ->setAttribute('template', '@ACSEOSyliusBrandPlugin/Admin/Brand/Tab/_media.html.twig')
            ->setLabel('sylius.ui.media')
        ;

        $this->eventDispatcher->dispatch(
            new BrandMenuBuilderEvent($this->factory, $menu, $options['brand']),
            self::EVENT_NAME,
        );

        return $menu;
    }
}
