<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use AppCore\Domain\Entity\Product;
use AppCore\Domain\Repository\ProductRepositoryInterface;
use AppCore\Domain\ValueObject\ProductId;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author Florent Blaison
 */
class ProductRepository implements ProductRepositoryInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findOneById(ProductId $productId) : ?Product
    {
        // TODO: Implement findOneById() method.
    }

    public function findByAmount(float $amount) : array
    {
        // TODO: Implement findByAmount() method.
    }

    public function findByCode(string $code) : ?Product
    {
        // TODO: Implement findByCode() method.
    }

    public function save(Product $product) : void
    {
        // TODO: Implement save() method.
    }
}
