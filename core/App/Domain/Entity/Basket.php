<?php

declare(strict_types=1);

namespace AppCore\Domain\Entity;

use AppCore\Domain\ValueObject\BasketId;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\Uuid;

/**
 * @author Florent Blaison
 */
class Basket
{
    private $id;

    /**
     * @var Collection|Product[]
     */
    private $products;

    private $creationDate;

    public function __construct()
    {
        $this->id = new BasketId(Uuid::uuid4());
        /** @noinspection PhpUnhandledExceptionInspection */
        $this->creationDate = new \DateTimeImmutable();
        $this->products = new ArrayCollection();
    }

    public function getId() : BasketId
    {
        return $this->id;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts() : Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product) : self
    {
        $this->products->add($product);

        return $this;
    }

    public function addProducts(Collection $products) : self
    {
        foreach ($products as $product) {
            $this->addProduct($product);
        }

        return $this;
    }

    public function countProducts() : int
    {
        return $this->products->count();
    }

    public function getAmount() : float
    {
        $amount = 0;
        foreach ($this->products as $product) {
            $amount += $product->getAmount();
        }

        return $amount;
    }

    public function clear() : void
    {
        $this->products->clear();
    }
}
