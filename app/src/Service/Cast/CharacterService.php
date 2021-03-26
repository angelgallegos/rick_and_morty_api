<?php
declare(strict_types=1);
namespace App\Service\Cast;

use App\Client\RickAndMorty\Model\External\Cast\Character;
use App\Client\RickAndMorty\Request\Cast\CharacterRequest;
use App\Client\RickAndMorty\Request\Exceptions\RequestException;
use App\Service\AbstractService;

class CharacterService extends AbstractService
{
    /**
     * @var CharacterRequest
     */
    private CharacterRequest $characterRequest;

    public function __construct(
        CharacterRequest $characterRequest
    ) {
        $this->characterRequest = $characterRequest;
    }

    /**
     * @param int $id
     * @return Character|null
     */
    public function get(int $id): ?Character
    {
        $character = null;
        try {
            $character = $this->characterRequest->one($id);
        } catch (RequestException $e) {
            $this->logger->alert("The request failed with the next exception: ".$e->getMessage());

            return null;
        }

        return $character;
    }

//home/angel/Projects/workspaces/JobsTestsWorkspace/hello-print/broker/operations/docker/php-apache/Dockerfile
//app id: 3bbd5693a4000498
//87d38b3fe132949261204e3bc6605acfa2143f0ef9360c9cbf4f8f91f2104285

//6033c2340e0ee
}