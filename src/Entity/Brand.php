<?php

declare(strict_types=1);

namespace ACSEO\SyliusBrandPlugin\Entity;

use ACSEO\SyliusBrandPlugin\Form\Type\BrandType;
use ACSEO\SyliusBrandPlugin\Grid\BrandGrid;
use ACSEO\SyliusBrandPlugin\Repository\BrandRepository;
use ACSEO\SyliusBrandPlugin\State\ImageUploadProcessor;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Resource\Metadata\AsResource;
use Sylius\Resource\Metadata\Create;
use Sylius\Resource\Metadata\Delete;
use Sylius\Resource\Metadata\Index;
use Sylius\Resource\Metadata\Update;

#[ORM\Entity(repositoryClass: BrandRepository::class)]
#[ORM\Table(name: 'acseo_brand')]
#[AsResource(
    alias: 'acseo.brand',
    section: 'admin',
    formType: BrandType::class,
    templatesDir: '@SyliusAdmin/shared/crud',
    driver: 'doctrine/orm',
    vars: [
        'header' => 'acseo.brand.ui.brands',
        'subheader' => 'acseo.brand.ui.brands',
    ],
    operations: [
        new Create(
            processor: ImageUploadProcessor::class,
        ),
        new Update(
            processor: ImageUploadProcessor::class,
            redirectToRoute: 'update',
        ),
        new Index(grid: BrandGrid::class),
        new Delete()
    ]
)]
class Brand implements BrandInterface
{
    use ProductsAwareTrait {
        ProductsAwareTrait::__construct as private __productsAwareTraitConstruct;
    }
    use ImagesAwareTrait {
        ImagesAwareTrait::__construct as private __imagesAwareTraitConstruct;
    }

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected ?int $id = null;

    #[ORM\Column(type: 'string', unique: true)]
    protected ?string $code = null;

    #[ORM\Column(type: 'string')]
    protected ?string $name = null;

    /**
     * @var Collection<int, ProductInterface>
     */
    #[ORM\OneToMany(
        mappedBy: 'brand',
        targetEntity: ProductInterface::class,
        fetch: 'EXTRA_LAZY'
    )]
    protected Collection $products;

    public function __construct()
    {
        $this->__imagesAwareTraitConstruct();
        $this->__productsAwareTraitConstruct();
    }

    public function __toString(): string
    {
        return (string) $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function addProduct(ProductInterface $product): void
    {
        if (!$this->hasProduct($product)) {
            $product->setBrand($this);
            $this->products->add($product);
        }
    }

    public function removeProduct(ProductInterface $product): void
    {
        if ($this->hasProduct($product)) {
            $product->setBrand(null);
            $this->products->removeElement($product);
        }
    }
}
