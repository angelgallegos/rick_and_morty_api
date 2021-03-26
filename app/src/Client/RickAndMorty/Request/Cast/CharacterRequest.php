<?php
declare(strict_types=1);
namespace App\Client\RickAndMorty\Request\Cast;

use App\Client\RickAndMorty\Api\Cast\CharacterApi;
use App\Client\RickAndMorty\Api\Exceptions\ApiException;
use App\Client\RickAndMorty\Factory\Cast\CharacterFactory;
use App\Client\RickAndMorty\Factory\Exceptions\FactoryException;
use App\Filter\FilterInterface;
use App\Client\RickAndMorty\Model\External\Cast\Character;
use App\Client\RickAndMorty\Model\External\Cast\Characters;
use App\Client\RickAndMorty\Request\AbstractRequest;
use App\Client\RickAndMorty\Request\Exceptions\RequestException;

class CharacterRequest extends AbstractRequest
{
    /**
     * @var CharacterApi
     */
    private CharacterApi $characterClient;

    /**
     * @var CharacterFactory
     */
    private CharacterFactory $characterFactory;

    /**
     * LocationRequest constructor.
     * @param CharacterApi $characterApi
     * @param CharacterFactory $characterFactory
     */
    public function __construct(
        CharacterApi $characterApi,
        CharacterFactory $characterFactory
    ) {
        $this->characterClient = $characterApi;
        $this->characterFactory = $characterFactory;
    }

    /**
     * @param int $id
     * @return Character|null
     * @throws RequestException
     */
    public function one(int $id): ?Character
    {
        try {
            $response = $this->characterClient->one($id);
        } catch (ApiException $e) {
            $context = [
                "resource" => Character::class,
                "id" => $id
            ];
            $this->logger->alert(
                "The API threw the following exception: ".$e->getMessage(),
                array_merge(
                    $e->getContext(),
                    $context
                )
            );
            throw RequestException::occurred($context);
        }

        return $this->characterFactory->createFromArray($response);
    }

    /**
     * @param FilterInterface $filter
     * @return Characters|null
     * @throws RequestException
     */
    public function filter(FilterInterface $filter): ?Characters
    {
        try {
            $response = $this->characterClient->filter($filter->toArray());
        } catch (ApiException $e) {

            $context = [
                "resource" => Character::class,
                "filter" => $filter->toArray()
            ];
            $this->logger->alert(
                "The API threw the following exception: ".$e->getMessage(),
                array_merge(
                    $e->getContext(),
                    $context
                )
            );
            throw RequestException::occurred($context);
        }

        return $this->characterFactory->createListFromArray($response);
    }

    /**
     * @param array $ids
     * @return Characters|null
     * @throws RequestException
     * @throws FactoryException
     */
    public function multiple(array $ids): ?Characters
    {
        try {
            $response = $this->characterClient->multiple($ids);
        } catch (ApiException $e) {
            $context = [
                "resource" => Character::class,
                "ids" => $ids
            ];
            $this->logger->alert(
                "The API threw the following exception: ".$e->getMessage(),
                array_merge(
                    $e->getContext(),
                    $context
                )
            );
            throw RequestException::occurred($context);
        }

        return $this->characterFactory->createListFromArray($response);
    }
}