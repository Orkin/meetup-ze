<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use AppCore\Domain\Entity\Basket;
use AppCore\Domain\Repository\BasketRepositoryInterface;
use AppCore\Domain\ValueObject\BasketId;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author Florent Blaison
 */
class BasketRepository implements BasketRepositoryInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findOneById(BasketId $basketId) : ?Basket
    {
        // TODO: Implement findOneById() method.
    }

    public function save(Basket $basket) : void
    {
        // TODO: Implement save() method.
    }
}
