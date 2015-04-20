<?php
namespace Wechat\Request\Message;

class Location extends AbstractMessage
{
    protected $locationX = null;
    protected $locationY = null;
    protected $scale     = null;
    protected $label     = null;
    
    protected function fields()
    {
        $arrFields = parent::fields();
        $arrFields['Location_X'] = 'setLocationX';
        $arrFields['Location_Y'] = 'setLocationY';
        $arrFields['Scale']      = 'setScale';
        $arrFields['Label']      = 'setLabel';
        return $arrFields;
    }
    
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
}