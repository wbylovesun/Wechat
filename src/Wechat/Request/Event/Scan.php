<?php
namespace Wechat\Request\Event;

class Unsubscribe extends AbstractEvent
{
    protected function setEventKey($eventKey)
    {
        $this->eventKey = $eventKey;
        return $this;
    }
    
    public function getEventKey()
    {
        return $this->eventKey;
    }
    
    protected function setTicket($ticket)
    {
        $this->ticket = $ticket;
        return $this;
    }
    
    public function getTicket()
    {
        return $this->ticket;
    }
    
    protected function setRequestParam($param, $element)
    {
        switch ($param) {
            case 'ToUserName':
                $this->setServiceProvider($element);
            break;
            case 'FromUserName':
                $this->setMessageTrigger($element);
            break;
            case 'CreateTime':
                $this->setCreateTime($element);
            break;
            case 'MsgType':
                $this->setMsgType($element);
            break;
            case 'Event':
                $this->setEvent($element);
            break;
            case 'EventKey':
                $this->setEventKey($element);
            break;
            case 'Ticket':
                $this->setTicket($element);
            break;
        }
    }
}