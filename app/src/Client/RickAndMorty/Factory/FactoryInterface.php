<?php

namespace App\Client\RickAndMorty\Factory;

use App\Client\RickAndMorty\Model\External\ExternalModelInterface;
use App\Client\RickAndMorty\Model\External\ExternalModelListInterface;

interface FactoryInterface
{
    /**
     * @param array $data
     * @return ExternalModelInterface|null
     */
    public function createFromArray(array $data): ?ExternalModelInterface;

    /**
     * @param array $results
     * @return ExternalModelListInterface|null
     */
    public function createListFromArray(array $results): ?ExternalModelListInterface;
}