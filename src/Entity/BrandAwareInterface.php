<?php

declare(strict_types=1);

namespace ACSEO\SyliusBrandPlugin\Entity;

interface BrandAwareInterface
{
    public function getBrand(): ?BrandInterface;

    public function setBrand(?BrandInterface $brand): void;
}
