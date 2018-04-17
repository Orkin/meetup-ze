<?php

declare(strict_types=1);

namespace AppCore\Domain\Entity;

use AppCore\Domain\Exception\Order\OrderException;
use AppCore\Domain\ValueObject\OrderId;
use AppCore\Domain\ValueObject\OrderStatus;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\Uuid;

/**
 * @author Florent Blaison
 */
class Order
{
    private $id;

    /**
     * @var Collection|Product[]
     */
    private $products;

    private $creationDate;

    private $modificationDate;

    private $payedDate;

    /**
     * @var OrderStatus
     */
    private $status;

    public function __construct(Collection $products)
    {
        $this->id = new OrderId(Uuid::uuid4());
        /** @noinspection PhpUnhandledExceptionInspection */
        $this->creationDate = new \DateTimeImmutable();
        $this->products = $products;

        /** @noinspection PhpUndefinedMethodInspection */
        $this->status = OrderStatus::WAITING_FOR_PAYMENT();
    }

    public function getAmount() : float
    {
        $amount = 0;
        foreach ($this->products as $product) {
            $amount += $product->getAmount();
        }
    }

    public function addProduct(Product $product) : self
    {
        $this->products->add($product);
        /** @noinspection PhpUnhandledExceptionInspection */
        $this->modificationDate = new \DateTimeImmutable();

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts() : Collection
    {
        return $this->products;
    }

    /**
     * @return OrderId
     */
    public function getId() : OrderId
    {
        return $this->id;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreationDate() : \DateTimeImmutable
    {
        return $this->creationDate;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getModificationDate() : \DateTimeImmutable
    {
        return $this->modificationDate;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getPayedDate() : \DateTimeImmutable
    {
        return $this->payedDate;
    }

    /**
     * @return OrderStatus
     */
    public function getStatus() : OrderStatus
    {
        return $this->status;
    }

    /**
     * @return $this
     * @throws OrderException
     */
    public function setPayed() : self
    {
        if ($this->status->is(OrderStatus::PAYED)) {
            throw OrderException::alreadyPayed();
        }

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->payedDate = new \DateTimeImmutable();
        /** @noinspection PhpUnhandledExceptionInspection */
        $this->modificationDate = new \DateTimeImmutable();
        /** @noinspection PhpUndefinedMethodInspection */
        $this->status = OrderStatus::PAYED();

        return $this;
    }

    /**
     * @return Order
     * @throws OrderException
     */
    public function setUnpayed() : self
    {
        if ($this->status->is(OrderStatus::PAYED)) {
            throw OrderException::alreadyPayed();
        }

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->modificationDate = new \DateTimeImmutable();
        /** @noinspection PhpUndefinedMethodInspection */
        $this->status = OrderStatus::PAYMENT_REFUSED();

        return $this;
    }
}
