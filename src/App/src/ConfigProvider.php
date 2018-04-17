<?php

declare(strict_types=1);

namespace App;

use App\Infrastructure\Repository\BasketRepository;
use App\Infrastructure\Repository\OrderRepository;
use App\Infrastructure\Repository\ProductRepository;
use AppCore\Domain\Repository\BasketRepositoryInterface;
use AppCore\Domain\Repository\OrderRepositoryInterface;
use AppCore\Domain\Repository\ProductRepositoryInterface;
use AppCore\Domain\Service\BasketService;
use AppCore\Domain\Service\OrderService;
use AppCore\Domain\Service\ProductService;
use AppCore\Infrastructure\Service\PaymentService;
use Doctrine\ORM\EntityManagerInterface;
use Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory;
use Zend\ServiceManager\Factory\InvokableFactory;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates' => $this->getTemplates(),
            ConfigAbstractFactory::class => [
                /* Repository */
                BasketRepository::class => [
                    EntityManagerInterface::class,
                ],
                OrderRepository::class => [
                    EntityManagerInterface::class,
                ],
                ProductRepository::class => [
                    EntityManagerInterface::class,
                ],

                /* Service */
                BasketService::class => [
                    BasketRepositoryInterface::class,
                ],
                OrderService::class => [
                    OrderRepositoryInterface::class,
                    ProductRepositoryInterface::class,
                    PaymentService::class,
                ],
                ProductService::class => [
                    ProductRepositoryInterface::class,
                ],
            ],
        ];
    }

    public function getDependencies() : array
    {
        return [
            'aliases' => [
                BasketRepositoryInterface::class => BasketRepository::class,
                OrderRepositoryInterface::class => OrderRepository::class,
                ProductRepositoryInterface::class => ProductRepository::class,
            ],
            'invokables' => [
                Handler\PingHandler::class => Handler\PingHandler::class,
            ],
            'factories' => [
                Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,

                /* Service */
                PaymentService::class => InvokableFactory::class,
                BasketService::class => ConfigAbstractFactory::class,
                OrderService::class => ConfigAbstractFactory::class,
                ProductService::class => ConfigAbstractFactory::class,

                /* Repository */
                BasketRepository::class => ConfigAbstractFactory::class,
                OrderRepository::class => ConfigAbstractFactory::class,
                ProductRepository::class => ConfigAbstractFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'app' => [__DIR__ . '/../templates/app'],
                'error' => [__DIR__ . '/../templates/error'],
                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
