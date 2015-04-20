<?php
namespace Wechat\Request\Event;

class Geo extends AbstractEvent
{
    protected $latitude  = null, $longitude = null, $precision = null;
    
    protected function fields()
    {
        $arrFields = parent::fields();
        $arrFields['Latitude']  = 'setLatitude';
        $arrFields['Longitude'] = 'setLongitude';
        $arrFields['Precision'] = 'setPrecision';
        return $arrFields;
    }
    
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
}