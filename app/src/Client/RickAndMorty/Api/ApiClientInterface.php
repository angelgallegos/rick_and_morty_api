<?php

namespace App\Client\RickAndMorty\Api;

/**
 * Interface ApiClientInterface
 *
 * Describes the functions used to connect wit the respective APIs
 */
interface ApiClientInterface
{
    /**
     * Retrieve a single result
     *
     * @param int $id
     * @return array
     */
    public function one(int $id): array;

    /**
     * Retrieve all the results
     *
     * @return array
     */
    public function all(): array;

    /**
     * Filter the results
     *
     * @param array $filter
     * @return array
     */
    public function filter(array $filter): array;

    /**
     * Retrieve multiple results by a list of ids
     *
     * @param array $ids
     * @return array
     */
    public function multiple(array $ids): array;
}