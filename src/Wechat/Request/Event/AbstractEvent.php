<?php
namespace Wechat\Request\Event;

use Exception;
use SimpleXmlElement;
use Wechat\Request\AbstractRequest;

abstract class AbstractEvent extends AbstractRequest
{
    protected $event = null;
    
    protected function setEvent($event)
    {
        $this->event = (string) $event;
        return $this;
    }
    
    public function fields()
    {
        $arrFields = parent::fields();
        $arrFields['Event'] = 'event';
        return $arrFields;
    }
    
    public function getEvent()
    {
        return $this->event;
    }
    
    /*
    protected function read()
    {
        $this->data = '';
        $f = fopen("php://input", "r");
        while ($s = fgets($f, 1024)) {
            $this->data .= $s;
        }
        return $this->data;
    }
    */
}