<?php

declare(strict_types=1);

namespace AppCore\Domain\Exception\Order;

/**
 * @author Florent Blaison
 */
class OrderException extends \Exception
{
    public static function alreadyPaid()
    {
        return new self('Order already paid');
    }
}
