<?php

declare(strict_types=1);

namespace ACSEO\SyliusBrandPlugin\Assigner;

use ACSEO\SyliusBrandPlugin\Entity\BrandInterface;
use Sylius\Component\Core\Model\ProductInterface;

interface ProductsAssignerInterface
{
    /**
     * @param ProductInterface[]|array $products
     */
    public function assign(BrandInterface $brand, array $products): void;
}
