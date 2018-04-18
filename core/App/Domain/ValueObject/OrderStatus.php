<?php

declare(strict_types=1);

namespace AppCore\Domain\ValueObject;

use ValueObjects\Enum\Enum;

/**
 * @author Florent Blaison
 */
class OrderStatus extends Enum
{
    const WAITING_FOR_PAYMENT = 'waiting_for_payment';
    const PAID = 'paid';
    const PAYMENT_REFUSED = 'payment_refused';
}
