<?php

namespace App\Filter;

interface FilterInterface
{
    /**
     * Returns the array of filter values
     *
     * @return array
     */
    public function toArray(): array;
}