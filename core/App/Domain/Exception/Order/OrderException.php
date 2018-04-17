<?php

declare(strict_types=1);

namespace AppCore\Domain\Exception\Order;

/**
 * @author Florent Blaison
 */
class OrderException extends \Exception
{
    public static function alreadyPayed()
    {
        return new self('Order already payed');
    }
}
