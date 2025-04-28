<?php

declare(strict_types=1);

namespace ACSEO\SyliusBrandPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\ImageInterface;

trait ImagesAwareTrait
{
    #[ORM\OneToMany(
        mappedBy: 'owner',
        targetEntity: BrandImage::class,
        cascade: ['all'],
        orphanRemoval: true
    )]
    // @phpstan-ignore-next-line
    protected Collection $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    // @phpstan-ignore-next-line
    public function getImages(): Collection
    {
        return $this->images;
    }

    /**
     * @return Collection<int|string, ImageInterface>
     */
    public function getImagesByType(string $type): Collection
    {
        return $this->images->filter(fn (ImageInterface $image) => $type === $image->getType());
    }

    public function hasImages(): bool
    {
        return !$this->images->isEmpty();
    }

    public function hasImage(ImageInterface $image): bool
    {
        return $this->images->contains($image);
    }

    public function addImage(ImageInterface $image): void
    {
        if (!$this->hasImage($image)) {
            $image->setOwner($this);
            $this->images->add($image);
        }
    }

    public function removeImage(ImageInterface $image): void
    {
        if ($this->hasImage($image)) {
            $image->setOwner(null);
            $this->images->removeElement($image);
        }
    }
}
