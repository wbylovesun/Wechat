<?php
namespace Wechat\Request\Message;

class Location extends AbstractMessage
{
    protected $locationX = null;
    protected $locationY = null;
    protected $scale     = null;
    protected $label     = null;
    
    protected function setLocationX($locationX)
    {
        $this->locationX = (string) $locationX;
        return $this;
    }
    
    public function getLocationX()
    {
        return $this->locationX;
    }
    
    protected function setLocationY($locationY)
    {
        $this->locationY = (string) $locationY;
        return $this;
    }
    
    public function getLocationY()
    {
        return $this->locationY;
    }
    
    protected function setScale($scale)
    {
        $this->scale = (string) $scale;
        return $this;
    }
    
    public function getScale()
    {
        return $this->scale;
    }
    
    protected function setLabel($label)
    {
        $this->label = (string) $label;
        return $this;
    }
    
    public function getLabel()
    {
        return $this->label;
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
            case 'Location_X':
                $this->setLocationX($element);
            break;
            case 'Location_Y':
                $this->setLocationY($element);
            break;
            case 'Scale':
                $this->setScale($element);
            break;
            case 'Label':
                $this->setLabel($element);
            break;
            case 'MsgId':
                $this->setMessageId($element);
            break;
        }
    }
}