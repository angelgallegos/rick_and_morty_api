<?php
declare(strict_types=1);
namespace App\Client\RickAndMorty\Factory\Episodes;

use App\Client\RickAndMorty\Factory\AbstractFactory;
use App\Client\RickAndMorty\Model\External\Episodes\Episode;
use App\Client\RickAndMorty\Model\External\Episodes\Episodes;
use JMS\Serializer\Serializer;
use Exception;

class EpisodeFactory extends AbstractFactory
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
    public function createFromArray(array $data): ?Episode
    {
        $character = null;
        try {
            $character = $this->serializer->deserialize(
                json_encode($data),
                Episode::class,
                'json'
            );
        } catch (Exception $e) {
            $this->logger->alert("There was an issue while deserializing the object: ".$e->getMessage());
        }

        return $character;
    }

    /**
     * @inheritDoc
     */
    public function createListFromArray(array $results): ?Episodes
    {
        $resultCollection = [];
        foreach ($results as $result) {
            $resultCollection[] = $this->serializer->deserialize(
                json_encode($result),
                Episode::class,
                'json'
            );
        }

        if (empty($resultCollection)) {
            return null;
        }

        return new Episodes(...$resultCollection);
    }
}