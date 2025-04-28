<?php

declare(strict_types=1);

namespace ACSEO\SyliusBrandPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

trait ProductsAwareTrait
{
    #[ORM\OneToMany(
        mappedBy: 'brand',
        targetEntity: ProductInterface::class,
        fetch: 'EXTRA_LAZY'
    )]
    // @phpstan-ignore-next-line
    protected Collection $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function hasProducts(): bool
    {
        return !$this->products->isEmpty();
    }

    // @phpstan-ignore-next-line
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function hasProduct(ProductInterface $product): bool
    {
        return $this->products->contains($product);
    }

    abstract public function addProduct(ProductInterface $product): void;

    abstract public function removeProduct(ProductInterface $product): void;
}
