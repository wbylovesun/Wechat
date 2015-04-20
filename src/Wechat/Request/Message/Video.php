<?php
namespace Wechat\Request\Message;

class Video extends AbstractMessage
{
    protected $thumbMediaId = null;
    protected $mediaId      = null;
    
    protected function fields()
    {
        $arrFields = parent::fields();
        $arrFields['ThumbMediaId']  = 'setThumbMediaId';
        $arrFields['MediaId']       = 'setMediaId';
        return $arrFields;
    }
    
    protected function setThumbMediaId($thumbMediaId)
    {
        $this->thumbMediaId = (string) $thumbMediaId;
        return $this;
    }
    
    public function getThumbMediaId()
    {
        return $this->thumbMediaId;
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
}