<?php

declare(strict_types=1);

namespace ACSEO\SyliusBrandPlugin\Repository;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use ACSEO\SyliusBrandPlugin\Entity\BrandInterface;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\ResourceRepositoryTrait;
use Sylius\Resource\Doctrine\Persistence\RepositoryInterface;

class BrandImageRepository extends ServiceEntityRepository implements RepositoryInterface
{
    use ResourceRepositoryTrait;

    public function createListQueryBuilder(string $brandCode): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->addSelect('brand')
            ->innerJoin('o.owner', 'brand', 'WITH', 'brand.code = :brandCode')
            ->setParameter('brandCode', $brandCode)
        ;
    }

    public function createPaginatorForBrandAndType(BrandInterface $brand, string $type): iterable
    {
        $queryBuilder = $this->createQueryBuilder('o')

            ->andWhere('o.type = :type')
            ->setParameter('type', $type)

            ->andWhere('o.owner = :brand')
            ->setParameter('brand', $brand)
        ;

        return $this->getPaginator($queryBuilder);
    }
}
