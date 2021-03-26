<?php
declare(strict_types=1);
namespace App\Client\RickAndMorty\Request\Exceptions;

use Exception;
use Throwable;

class NoResponseException extends Exception
{
    /**
     * More information relevant to the exception
     * @var array
     */
    private array $context;

    /**
     * @return array
     */
    public function getContext(): array
    {
        return $this->context;
    }

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
     * Creates a new Instance of this Exception
     *
     * @param array $context
     * @return static
     */
    public static function occurred(array $context): self
    {
        return new NoResponseException(
            "There were no results found with the request",
            404,
            null,
            $context
        );
    }
}