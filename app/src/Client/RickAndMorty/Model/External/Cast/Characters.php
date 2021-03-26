<?php
declare(strict_types=1);
namespace App\Client\RickAndMorty\Model\External\Cast;

use App\Client\RickAndMorty\Model\External\ExternalModelListInterface;

/**
 * Collection class for Character instances
 */
final class Characters implements ExternalModelListInterface
{
    /**
     * @var Character[]
     */
    private array $characters;

    /**
     * Locations constructor.
     * @param Character ...$characters
     */
    public function __construct(Character ...$characters)
    {
        $this->characters = $characters;
    }

    /**
     * Add Character to list.
     *
     * @param Character $character
     *
     * @return void
     */
    public function add(Character $character): void
    {
        $this->characters[] = $character;
    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        return $this->characters;
    }

    /**
     * @return array
     */
    public function getIds(): array
    {
        return array_map(function($e) {
            return $e->getId();
        }, $this->characters);
    }
}