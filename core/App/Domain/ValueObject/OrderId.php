<?php

declare(strict_types=1);

namespace AppCore\Domain\ValueObject;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class OrderId implements ValueObjectInterface
{
    /**
     * @var UuidInterface
     */
    private $id;

    public function __construct(UuidInterface $id)
    {
        $this->id = $id;
    }

    /**
     * Returns a object taking PHP native value(s) as argument(s).
     *
     * @return self
     */
    public static function fromNative()
    {
        $args = \func_get_args();

        if (\count($args) != 1) {
            throw new \BadMethodCallException(
                'You must provide at least one argument'
            );
        }

        return new static(Uuid::fromString($args[0]));
    }

    /**
     * Compare two ValueObjectInterface and tells whether they can be considered equal
     *
     * @param OrderId|ValueObjectInterface $orderId
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $orderId)
    {
        if (false === Util::classEquals($this, $orderId)) {
            return false;
        }

        return $this->getId()->equals($orderId->getId());
    }

    /**
     * Returns a string representation of the object
     *
     * @return string
     */
    public function __toString() : string
    {
        return $this->toNative();
    }

    /**
     * @return string
     */
    public function toNative() : string
    {
        return $this->getId()->toString();
    }

    /**
     * @return UuidInterface
     */
    public function getId() : UuidInterface
    {
        return $this->id;
    }
}
