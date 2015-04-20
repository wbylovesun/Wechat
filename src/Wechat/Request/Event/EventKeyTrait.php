<?php
namespace Wechat\Request\Event;

Trait EventKeyTrait
{
    protected $eventKey = null;
    
    protected function setEventKey($eventKey)
    {
        $this->eventKey = $eventKey;
        return $this;
    }
    
    public function getEventKey()
    {
        return $this->eventKey;
    }
}