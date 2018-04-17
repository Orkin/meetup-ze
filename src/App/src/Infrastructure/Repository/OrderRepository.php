<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use AppCore\Domain\Entity\Order;
use AppCore\Domain\Repository\OrderRepositoryInterface;
use AppCore\Domain\ValueObject\OrderId;
use AppCore\Domain\ValueObject\UserId;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author Florent Blaison
 */
class OrderRepository implements OrderRepositoryInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findOneById(OrderId $orderId) : ?Order
    {
        // TODO: Implement findOneById() method.
    }

    public function findByAmount(float $amount) : array
    {
        // TODO: Implement findByAmount() method.
    }

    public function findByUser(UserId $userId) : array
    {
        // TODO: Implement findByUser() method.
    }

    public function save(Order $order) : void
    {
        // TODO: Implement save() method.
    }
}
