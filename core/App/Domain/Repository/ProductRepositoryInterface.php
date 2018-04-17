<?php

declare(strict_types=1);

namespace AppCore\Domain\Repository;

use AppCore\Domain\Entity\Product;
use AppCore\Domain\ValueObject\ProductId;

/**
 * @author Florent Blaison
 */
interface ProductRepositoryInterface
{
    public function findOneById(ProductId $productId) : ?Product;

    public function findByAmount(float $amount) : array;

    public function findByCode(string $code) : ?Product;

    public function save(Product $product) : void;
}
