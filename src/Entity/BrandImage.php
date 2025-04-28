<?php

/*
 * This file is part of Camille islasse's Sylius Brand Plugin for Sylius.
 * (c) Camille islasse <cams.development@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ACSEO\SyliusBrandPlugin\Entity;

use ACSEO\SyliusBrandPlugin\State\ImageUploadProcessor;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\Image;
use Sylius\Resource\Metadata\Create;
use Sylius\Resource\Metadata\Update;
use Symfony\Component\Validator\Constraints as Assert;
use Sylius\Bundle\CoreBundle\Validator\Constraints as SyliusAssert;
use Sylius\Resource\Metadata\AsResource;

#[ORM\Entity]
#[ORM\Table(name: 'acseo_brand_image')]
#[AsResource(
    operations: [
        new Create(
            processor: ImageUploadProcessor::class,
        ),
        new Update(
            processor: ImageUploadProcessor::class,
        ),
    ],
)]
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

    #[Assert\File(
        maxSize: '5M',
        uploadIniSizeErrorMessage: 'sylius.avatar_image.file.upload_ini_size',
        groups: ['sylius']
    )]
    #[SyliusAssert\AllowedImageMimeTypes(groups: ['sylius'])]
    protected $file;

    #[Assert\NotBlank(groups: ['sylius'])]
    protected $type;

    public function isLogo(): bool
    {
        return self::TYPE_LOGO === $this->getType();
    }


    public function getBrand(): ?object
    {
        return $this->getOwner();
    }

    public function setBrand(?BrandInterface $brand): void
    {
        $this->setOwner($brand);
    }
}
