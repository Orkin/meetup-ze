<?php

declare(strict_types=1);

namespace AppCore\Domain\Entity;

use AppCore\Domain\ValueObject\ProductId;
use AppCore\Domain\ValueObject\ProductStatus;
use Ramsey\Uuid\Uuid;

/**
 * @author Florent Blaison
 */
class Product
{
    private $id;

    private $code;

    private $name;

    private $creationDate;

    private $modificationDate;

    private $imageUrl;

    private $amountHT;

    private $taxValue;

    /**
     * @var ProductStatus
     */
    private $status;

    public function __construct(string $code, string $name, string $imageUrl, float $amountHT, float $taxValue)
    {
        $this->id = new ProductId(Uuid::uuid4());
        /** @noinspection PhpUnhandledExceptionInspection */
        $this->creationDate = new \DateTimeImmutable();
        $this->code = $code;
        $this->name = $name;
        $this->imageUrl = $imageUrl;
        $this->amountHT = $amountHT;
        $this->taxValue = $taxValue;
        /** @noinspection PhpUndefinedMethodInspection */
        $this->status = ProductStatus::DISABLED();
    }

    public function getId() : ProductId
    {
        return $this->id;
    }

    public function getCode() : string
    {
        return $this->code;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName(string $name) : self
    {
        $this->name = $name;

        return $this;
    }

    public function getCreationDate() : \DateTimeImmutable
    {
        return $this->creationDate;
    }

    public function getModificationDate() : \DateTimeImmutable
    {
        return $this->modificationDate;
    }

    public function setModificationDate(\DateTimeImmutable $modificationDate) : self
    {
        $this->modificationDate = $modificationDate;

        return $this;
    }

    public function getImageUrl() : string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl) : self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getAmountHT() : float
    {
        return $this->amountHT;
    }

    public function setAmountHT(float $amountHT) : self
    {
        $this->amountHT = $amountHT;

        return $this;
    }

    public function getTaxValue() : float
    {
        return $this->taxValue;
    }

    public function setTaxValue(float $taxValue) : self
    {
        $this->taxValue = $taxValue;

        return $this;
    }

    /**
     * @return ProductStatus
     */
    public function getStatus() : ProductStatus
    {
        return $this->status;
    }

    public function disable() : self
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $this->status = ProductStatus::DISABLED();
    }

    public function enable() : self
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $this->status = ProductStatus::ENABLED();
    }

    /**
     * @return float
     */
    public function getAmount() : float
    {
        return $this->amountHT * (1 + ($this->taxValue / 100));
    }
}
