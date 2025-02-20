<?php

namespace App\Iterator;

use Iterator;

class OfferCollectionIterator implements Iterator
{
    private array $array;
    private int $position = 0;

    public function __construct(array $array)
    {
        $this->array = $array;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function current(): mixed
    {
        return $this->array[$this->position] ?? null;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function next(): void
    {
        $this->position++;
    }

    public function valid(): bool
    {
        return array_key_exists($this->position, $this->array);
    }
}
