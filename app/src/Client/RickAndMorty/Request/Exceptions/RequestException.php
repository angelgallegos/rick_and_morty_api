<?php
declare(strict_types=1);
namespace App\Client\RickAndMorty\Request\Exceptions;

use Exception;
use Throwable;

class RequestException extends Exception
{
    /**
     * More information relevant to the exception
     * @var array
     */
    private array $context;

    /**
     * RequestException constructor.
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
     * Creates a new Instance of this Exception
     *
     * @param array $context
     * @return static
     */
    public static function occurred(array $context): self
    {
        return new RequestException(
            "There was an error requesting the Model",
            500,
            null,
            $context
        );
    }
}