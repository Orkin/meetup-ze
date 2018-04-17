<?php

declare(strict_types=1);

namespace AppCore\Domain\Repository;

use AppCore\Domain\Entity\Basket;
use AppCore\Domain\ValueObject\BasketId;

/**
 * @author Florent Blaison
 */
interface BasketRepositoryInterface
{
    public function findOneById(BasketId $basketId) : ?Basket;

    public function save(Basket $basket) : void;
}
