<?php
declare(strict_types=1);

namespace App\Service;

use Monolog\Logger;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

class AbstractService implements LoggerAwareInterface
{
    /**
     * @var Logger
     */
    protected Logger $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}