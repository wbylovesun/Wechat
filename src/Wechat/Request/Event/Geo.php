<?php
namespace Wechat\Request\Event;

class Geo extends AbstractEvent
{
    protected $latitude  = null;
    protected $longitude = null;
    protected $precision = null;
    
    protected function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }
    
    public function getLatitude()
    {
        return $this->latitude;
    }
    
    protected function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }
    
    public function getLongitude()
    {
        return $this->longitude;
    }
    
    protected function setPrecision($precision)
    {
        $this->precision = $precision;
        return $this;
    }
    
    public function getPrecision()
    {
        return $this->precision;
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
            case 'Latitude':
                $this->setLatitude($element);
            break;
            case 'Longitude':
                $this->setLongitude($element);
            break;
            case 'Precision':
                $this->setPrecision($element);
            break;
        }
    }
}