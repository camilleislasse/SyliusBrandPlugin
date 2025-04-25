<?php

/*
 * This file is part of Camille islasse's Sylius Brand Plugin for Sylius.
 * (c) Camille islasse <cams.development@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ACSEO\SyliusBrandPlugin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\Image;
use Sylius\Component\Core\Model\ImageInterface;

#[ORM\Entity]
#[ORM\Table(name: 'acseo_brand_image')]
class BrandImage extends Image implements BrandAwareInterface
{
    public const TYPE_LOGO = 'logo';

    #[ORM\ManyToOne(
        targetEntity: BrandInterface::class,
        inversedBy: 'images'
    )]
    #[ORM\JoinColumn(
        name: 'owner_id',
        referencedColumnName: 'id',
        nullable: false,
        onDelete: 'CASCADE'
    )]
    protected $owner;

    public function isLogo(): bool
    {
        return self::TYPE_LOGO === $this->getType();
    }

    public function getBrand(): ?BrandInterface
    {
        /** @var BrandInterface|null $brand */
        return $this->getOwner();
    }

    public function setBrand(?BrandInterface $brand): void
    {
        $this->setOwner($brand);
    }
}
