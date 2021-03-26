<?php
declare(strict_types=1);
namespace App\Client\RickAndMorty\Api\Exceptions;

use Doctrine\DBAL\Exception;
use Throwable;

class ApiException extends Exception
{
    /**
     * @var array
     */
    private array $context;

    /**
     * ApiException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     * @param array $context
     */
    public function __construct(
        $message = "",
        $code = 0,
        Throwable $previous = null,
        array $context = []
    ) {
        $this->context = $context;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return array
     */
    public function getContext(): array
    {
        return $this->context;
    }

    /**
     * @param array $response
     * @return static
     */
    public static function buildWithError(array $response): self
    {
        return new ApiException(
            "There was an error retrieving the data from the API",
            500,
            null,
            $response
        );
    }
}