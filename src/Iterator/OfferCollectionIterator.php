<?php

namespace App\Iterator;

class OfferCollectionIterator implements \Iterator
{
    
    private $array;
    private $position = 0;

    public function __construct( $json ) {
      $this->array = $json;
    }

    public function rewind():void {
        $this->position = 0;
    }

    public function current() {
        return $this->array[$this->position];
    }

    public function key() {
        return $this->position;
    }

    public function next():void {
        ++$this->position;
    }

    public function valid(): bool {
        return isset($this->array[$this->position]);
    }
    
}
