<?php

declare(strict_types=1);

namespace ACSEO\SyliusBrandPlugin\Entity;

use Doctrine\Common\Collections\Collection;

interface ProductsAwareInterface
{
    public function hasProducts(): bool;

    /**
     * @return Collection<int|string, ProductInterface>
     */
    public function getProducts(): Collection;

    public function hasProduct(ProductInterface $product): bool;

    public function addProduct(ProductInterface $product): void;

    public function removeProduct(ProductInterface $product): void;
}
