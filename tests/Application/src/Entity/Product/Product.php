<?php

declare(strict_types=1);

namespace Tests\ACSEO\SyliusBrandPlugin\Entity\Product;

use ACSEO\SyliusBrandPlugin\Entity\BrandAwareInterface;
use ACSEO\SyliusBrandPlugin\Entity\ProductInterface;
use ACSEO\SyliusBrandPlugin\Entity\ProductTrait;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\Product as BaseProduct;

#[ORM\Entity]
#[ORM\Table(name: 'sylius_product')]
class Product extends BaseProduct implements ProductInterface
{
    use ProductTrait;
}
