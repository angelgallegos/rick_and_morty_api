<?php

namespace App\Client\RickAndMorty\Model\External;

/**
 * Blueprint for the collection objects
 */
interface ExternalModelListInterface
{
    /**
     * Return all the elements of the collection
     *
     * @return array
     */
    public function all(): array;
}