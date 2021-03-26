<?php
declare(strict_types=1);
namespace App\Client\RickAndMorty\Factory\Cast;

use __\__;
use App\Client\RickAndMorty\Factory\AbstractFactory;
use App\Client\RickAndMorty\Factory\Exceptions\FactoryException;
use App\Client\RickAndMorty\Model\External\Cast\Character;
use App\Client\RickAndMorty\Model\External\Cast\Characters;
use JMS\Serializer\Serializer;
use \Exception;

/**
 * Builds instances of Character and Characters
 */
class CharacterFactory extends AbstractFactory
{
    /**
     * @var Serializer
     */
    public Serializer $serializer;

    /**
     * CharacterFactory constructor.
     * @param Serializer $serializer
     */
    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @inheritDoc
     */
    public function createFromArray(array $data): ?Character
    {
        $character = null;
        try {
            $character = $this->serializer->deserialize(
                json_encode($data),
                Character::class,
                'json'
            );
        } catch (Exception $e) {
            $this->logger->alert("There was an issue while deserializing the object: ".$e->getMessage());
        }

        return $character;
    }

    /**
     * @inheritDoc
     * @throws FactoryException
     */
    public function createListFromArray(array $results): ?Characters
    {
        $resultCollection = [];
        foreach ($results as $result) {
            $resultCollection[] = $this->serializer->deserialize(
                json_encode($result),
                Character::class,
                'json'
            );
        }

        if (__::isEmpty($resultCollection)) {
            throw FactoryException::occurred([
                "results" => $results
            ]);
        }

        return new Characters(...$resultCollection);
    }
}