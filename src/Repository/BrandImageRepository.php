<?php

declare(strict_types=1);

namespace ACSEO\SyliusBrandPlugin\Repository;


use ACSEO\SyliusBrandPlugin\Entity\BrandImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use ACSEO\SyliusBrandPlugin\Entity\BrandInterface;
use Doctrine\Persistence\ManagerRegistry;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\ResourceRepositoryTrait;
use Sylius\Component\Resource\Repository\RepositoryInterface;

// @phpstan-ignore-next-line
class BrandImageRepository extends ServiceEntityRepository implements RepositoryInterface
{
    use ResourceRepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BrandImage::class);
    }
}
