<?php

declare(strict_types=1);

namespace ACSEO\SyliusBrandPlugin\Entity;

use Doctrine\ORM\Mapping as ORM;

trait ProductTrait
{
    #[ORM\ManyToOne(
        targetEntity: BrandInterface::class,
        cascade: ['persist'],
        fetch: 'EAGER',
        inversedBy: 'products'
    )]
    #[ORM\JoinColumn(name: 'brand_id', referencedColumnName: 'id', onDelete: 'SET NULL')]
    protected ?BrandInterface $brand = null;

    public function getBrand(): ?BrandInterface
    {
        return $this->brand;
    }

    public function setBrand(?BrandInterface $brand): void
    {
        $this->brand = $brand;
    }
}
