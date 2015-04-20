<?php
namespace Wechat\Request\Message;

class Voice extends AbstractMessage
{
    protected $format      = null;
    protected $mediaId     = null;
    protected $recognition = null;
    
    protected function fields()
    {
        $arrFields = parent::fields();
        $arrFields['Format']      = 'setFormat';
        $arrFields['MediaId']     = 'setMediaId';
        $arrFields['Recognition'] = 'setRecognition';
        return $arrFields;
    }
    
    protected function setFormat($format)
    {
        $this->format = (string) $format;
        return $this;
    }
    
    public function getFormat()
    {
        return $this->format;
    }
    
    protected function setMediaId($mediaId)
    {
        $this->mediaId = (string) $mediaId;
        return $this;
    }
    
    public function getMediaId()
    {
        return $this->mediaId;
    }
    
    protected function setRecognition($recognition)
    {
        $this->recognition = (string) $recognition;
        return $this;
    }
    
    public function getRecognition()
    {
        return $this->recognition;
    }
}