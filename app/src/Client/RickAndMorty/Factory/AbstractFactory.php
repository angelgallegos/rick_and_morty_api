<?php
declare(strict_types=1);
namespace App\Client\RickAndMorty\Factory;

use Monolog\Logger;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

abstract class AbstractFactory implements FactoryInterface, LoggerAwareInterface
{
    /**
     * @var Logger
     */
    protected Logger $logger;

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}