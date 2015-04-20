<?php
namespace Wechat\Request\Event;

Trait TicketTrait
{
    protected $ticket = null;
    
    protected function setTicket($ticket)
    {
        $this->ticket = $ticket;
        return $this;
    }
    
    public function getTicket()
    {
        return $this->ticket;
    }
}