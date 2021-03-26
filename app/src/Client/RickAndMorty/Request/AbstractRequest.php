<?php
declare(strict_types=1);
namespace App\Client\RickAndMorty\Request;

use Monolog\Logger;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

/**
 * Common methods for the Request classes
 */
abstract class AbstractRequest implements RequestInterface, LoggerAwareInterface
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