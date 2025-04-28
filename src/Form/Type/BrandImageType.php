<?php

declare(strict_types=1);

namespace ACSEO\SyliusBrandPlugin\Form\Type;

use ACSEO\SyliusBrandPlugin\Entity\Brand;
use Sylius\Bundle\CoreBundle\Form\Type\ImageType;



final class BrandImageType extends ImageType
{
    public function __construct(string $dataClass = Brand::class)
    {
        parent::__construct($dataClass);
    }
}
