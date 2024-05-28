<?php

namespace Datastructure;

class Stack
{
    private $item;

    public function addToStack($data)
    {
        if(isset($this->item)) {
            $stackItem = new StackItem($data, $this->item);
        } else {
            $stackItem = new StackItem($data, null);
        }
        $this->item = $stackItem;
    }

    public function returnStackData()
    {
        if(!$this->isStackNotEmpty()) {
            return false;
        }
        $data = $this->item->getData();
        $this->item = $this->item->getPrevious();
        return $data;
    }

    public function isStackNotEmpty()
    {
        return isset($this->item);
    }
}

class StackItem
{
    private $data;
    private $previous;

    public function __construct($data, $previous)
    {
        $this->data = $data;
        $this->previous = $previous;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getPrevious()
    {
        return $this->previous;
    }
}
