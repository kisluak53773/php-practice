<?php

namespace Datastructure;

class Deque
{
    private $end;
    private $start;

    public function push($data)
    {
        if($this->isNotEmpty()) {
            $item = new DequeItem($data);
            $item->setPrevious($this->end);
            $this->end = $item;
        } else {
            $item = new DequeItem($data);
            $this->end = $item;
            $this->start = $item;
        }
    }

    public function unshift($data)
    {
        if($this->isNotEmpty()) {
            $item = new DequeItem($data);
            $item->setNext($this->start);
            $this->start = $item;
        } else {
            $item = new DequeItem($data);
            $this->end = $item;
            $this->start = $item;
        }
    }

    public function getEnd()
    {
        if($this->isNotEmpty()) {
            return $this->end->getData();
        } else {
            return false;
        }
    }

    public function getStart()
    {
        if($this->isNotEmpty()) {
            return $this->start->getData();
        } else {
            return false;
        }
    }

    public function pop()
    {
        if($this->isNotEmpty() && $this->end->getPrevious() !== null) {
            $data = $this->end->getData();
            $this->end = $this->end->getPrevious();
            return $data;
        } elseif($this->isNotEmpty() && $this->end->getPrevious() === null) {
            $data = $this->end->getData();
            $this->end = null;
            $this->start = null;
            return $data;
        } else {
            return false;
        }
    }

    public function shift()
    {
        if($this->isNotEmpty() && $this->end->getNext() !== null) {
            $data = $this->start->getData();
            $this->start = $this->start->getNext();
            return $data;
        } elseif($this->isNotEmpty() && $this->end->getNext() === null) {
            $data = $this->start->getData();
            $this->end = null;
            $this->start = null;
            return $data;
        } else {
            return false;
        }
    }

    public function isNotEmpty()
    {
        return isset($this->end) && isset($this->start);
    }
}

class DequeItem
{
    private $next;
    private $previous;
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function setNext(DequeItem $item)
    {
        $this->next = $item;
    }

    public function setPrevious(DequeItem $item)
    {
        $this->previous = $item;
    }

    public function getPrevious()
    {
        return $this->previous;
    }

    public function getNext()
    {
        return $this->next;
    }

    public function getData()
    {
        return $this->data;
    }
}
