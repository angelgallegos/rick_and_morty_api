<?php
declare(strict_types=1);
namespace App\Client\RickAndMorty\Request;

use App\Filter\FilterInterface;
use App\Client\RickAndMorty\Model\External\ExternalModelInterface;
use App\Client\RickAndMorty\Model\External\ExternalModelListInterface;

/**
 * Definition for the Request classes which take care of calling
 * the APIs and build the returned resources
 */
interface RequestInterface
{
    /**
     * Retrieves a Resource from the API and hydrates it
     *
     * @param int $id
     * @return ExternalModelInterface|null
     */
    public function one(int $id): ?ExternalModelInterface;

    /**
     * Retrieves a List of Resource from the API,
     * based on the supplied FilterInterface,
     * and hydrates them
     *
     * @param FilterInterface $filter
     * @return ExternalModelListInterface|null
     */
    public function filter(FilterInterface $filter): ?ExternalModelListInterface;

    /**
     * Retrieves a List of Resource from the API,
     * based on the supplied array of ids,
     * and hydrates them
     *
     * @param array $ids
     * @return ExternalModelListInterface|null
     */
    public function multiple(array $ids): ?ExternalModelListInterface;
}