<?php
declare(strict_types=1);
namespace App\Client\RickAndMorty\Api;

use Monolog\Logger;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

/**
 * Common methods for the Api classes
 */
abstract class AbstractApi implements ApiClientInterface, LoggerAwareInterface
{
    /**
     * @var Logger
     */
    protected Logger $logger;

    /**
     * @inheritDoc
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}