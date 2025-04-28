<?php

namespace ACSEO\SyliusBrandPlugin\State;

use ACSEO\SyliusBrandPlugin\Entity\Brand;
use ACSEO\SyliusBrandPlugin\Entity\BrandImage;
use Sylius\Component\Core\Uploader\ImageUploaderInterface;
use Sylius\Resource\Context\Context;
use Sylius\Resource\Doctrine\Common\State\PersistProcessor;
use Sylius\Resource\Metadata\Operation;
use Sylius\Resource\State\ProcessorInterface;
use Webmozart\Assert\Assert;

final class ImageUploadProcessor implements ProcessorInterface
{
    public function __construct(
        private readonly ImageUploaderInterface $uploader,
        private PersistProcessor $decorated,
    ) {
    }

    public function process(mixed $data, Operation $operation, Context $context): mixed
    {
        Assert::isInstanceOf($data, Brand::class);

        $images = $data->getImages();

        /** @var BrandImage $image */
        foreach ($images as $image) {
            if ($image->hasFile()) {
                $this->uploader->upload($image);
            }
        }
        $this->decorated->process($data, $operation, $context);

        return $data;
    }
}
