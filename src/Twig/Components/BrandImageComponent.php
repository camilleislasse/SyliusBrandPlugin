<?php

namespace ACSEO\SyliusBrandPlugin\Twig\Components;

use ACSEO\SyliusBrandPlugin\Entity\Brand;
use ACSEO\SyliusBrandPlugin\Form\Type\BrandType;
use Sylius\TwigHooks\LiveComponent\HookableLiveComponentTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\LiveCollectionTrait;

#[AsLiveComponent(template: '@SyliusAdmin/shared/crud/common/content/form.html.twig')]
class BrandImageComponent extends AbstractController
{
    use LiveCollectionTrait;
    use DefaultActionTrait;
    use HookableLiveComponentTrait;

    #[LiveProp]
    public Brand $resource;

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(BrandType::class, $this->resource);
    }
}
