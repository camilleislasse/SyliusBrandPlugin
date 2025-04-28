<?php

/*
 * This file is part of Camille islasse's Sylius Brand Plugin for Sylius.
 * (c) Camille islasse <cams.development@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ACSEO\SyliusBrandPlugin\Repository;

use ACSEO\SyliusBrandPlugin\Entity\Brand;
use ACSEO\SyliusBrandPlugin\Entity\BrandImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\ResourceRepositoryTrait;
use Sylius\Component\Resource\Repository\RepositoryInterface;

// @phpstan-ignore-next-line
class BrandRepository extends ServiceEntityRepository implements RepositoryInterface
{
    use ResourceRepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Brand::class);
    }
}
