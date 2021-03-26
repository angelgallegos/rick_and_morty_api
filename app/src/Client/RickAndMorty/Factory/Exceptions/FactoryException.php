<?php
declare(strict_types=1);
namespace App\Client\RickAndMorty\Factory\Exceptions;

use Exception;
use Throwable;

class FactoryException extends Exception
{
    /**
     * More information relevant to the exception
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
     * Creates a new Instance of this Exception
     *
     * @param array $context
     * @return static
     */
    public static function occurred(array $context): self
    {
        return new FactoryException(
            "There was an error building the Model",
            500,
            null,
            $context
        );
    }
}