<?php

declare(strict_types=1);

namespace AppCore\Domain\Repository;

use AppCore\Domain\Entity\Order;
use AppCore\Domain\ValueObject\OrderId;
use AppCore\Domain\ValueObject\UserId;

/**
 * @author Florent Blaison
 */
interface OrderRepositoryInterface
{
    public function findOneById(OrderId $orderId) : ?Order;

    public function findByAmount(float $amount) : array;

    public function findByUser(UserId $userId) : array;

    public function save(Order $order) : void;
}
