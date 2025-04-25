<?php

declare(strict_types=1);

namespace ACSEO\SyliusBrandPlugin\Entity;


use Sylius\Component\Core\Model\ImagesAwareInterface;
use Sylius\Component\Resource\Model\CodeAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

interface BrandInterface extends ResourceInterface, CodeAwareInterface, ProductsAwareInterface, ImagesAwareInterface
{

    public function __toString(): string;

    public function getId(): ?int;

    public function getName(): ?string;

    public function setName(?string $name): void;
}
