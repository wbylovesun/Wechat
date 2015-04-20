<?php
namespace Wechat\Request\Event;

class Scan extends AbstractEvent
{
    use EventKeyTrait, TicketTrait;
    
    protected function fields()
    {
        $arrFields = parent::fields();
        $arrFields['EventKey'] = 'setEventKey';
        $arrFields['Ticket']   = 'setTicket';
        return $arrFields;
    }
}