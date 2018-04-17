<?php

declare(strict_types=1);

namespace AppCore\Infrastructure\Service;

/**
 * @author Florent Blaison
 */
class PaymentService
{
    public function processPayment(float $amount) : bool
    {
        return rand(0, 1) === 0;
    }
}
