<?php

declare(strict_types=1);

namespace AppCore\Domain\ValueObject;

use ValueObjects\Enum\Enum;

/**
 * @author Florent Blaison
 */
class ProductStatus extends Enum
{
    const DISABLED = 'disabled';
    const ENABLED = 'enabled';
}
