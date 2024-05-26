<?php

namespace Datastructure;

class Queue{
    private $queueStart;
    private $queueEnd;

    public function addToQueue($data){
        if($this->isQueueNotEmpty()){
            $queueItem = new QueueuItem($data);
            $this->queueEnd->setNext($queueItem);
            $this->queueEnd = $queueItem;
        }else{
            $queueItem = new QueueuItem($data);
            $this->queueStart=$queueItem;
            $this->queueEnd=$queueItem;
        }
    }

    public function resolveQueueItem(){
        if($this->isQueueNotEmpty() && isset($this->queueStart->getNext())){
            $data = $this->queueStart->getData();
            $this->queueStart = $this->queueStart->getNext();
            return $data;
        }else if($this->isQueueNotEmpty() && !isset($this->queueStart->getNext())){
            $data = $this->queueStart->getData();
            $this->queueStart = null;
            $this->queueEnd= null;
            return $data;
        }else{
            return false;
        }
    }

    public function isQueueNotEmpty(){
        return isset($this->queueStart) && isset($this->queueEnd);
    }
}

class QueueuItem{
    private $data;
    private $next;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function setNext(QueueuItem $item){
        $this->next=$item;
    }

    public function getData(){
        return $this->data;
    }

    public function getNext(){
        return $this->next;
    }
}