<?php

declare(strict_types=1);

namespace AppCore\Domain\Service;

use AppCore\Domain\Entity\Basket;
use AppCore\Domain\Entity\Order;
use AppCore\Domain\Repository\OrderRepositoryInterface;
use AppCore\Domain\Repository\ProductRepositoryInterface;
use AppCore\Domain\ValueObject\OrderId;
use AppCore\Domain\ValueObject\ProductId;
use AppCore\Infrastructure\Service\PaymentService;

/**
 * @author Florent Blaison
 */
class OrderService
{
    private $orderRepository;

    private $productRepository;

    private $paymentService;

    public function __construct(OrderRepositoryInterface $orderRepository, ProductRepositoryInterface $productRepository, PaymentService $paymentService)
    {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
        $this->paymentService = $paymentService;
    }

    public function createFromBasket(Basket $basket) : Order
    {
        $order = new Order($basket->getProducts());

        $this->orderRepository->save($order);

        return $order;
    }

    public function addProductToOrder(ProductId $productId, OrderId $orderId) : Order
    {
        $product = $this->productRepository->findOneById($productId);
        $order = $this->orderRepository->findOneById($orderId);

        $order->addProduct($product);
        $this->orderRepository->save($order);

        return $order;
    }

    /**
     * @param OrderId $orderId
     *
     * @return Order
     * @throws \AppCore\Domain\Exception\Order\OrderException
     */
    public function payOrder(OrderId $orderId) : Order {
        $order = $this->orderRepository->findOneById($orderId);
        if ($this->paymentService->processPayment($order->getAmount())) {
            $order->setPaid();
        } else {
            $order->setUnpaid();
        }

        $this->orderRepository->save($order);

        return $order;
    }
}
