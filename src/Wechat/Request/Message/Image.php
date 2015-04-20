<?php
namespace Wechat\Request\Message;

class Image extends AbstractMessage
{
    protected $picurl  = null, $mediaId = null;
    
    protected function fields()
    {
        $arrFields = parent::fields();
        $arrFields['PicUrl']  = 'setPicUrl';
        $arrFields['MediaId'] = 'setMediaId';
        return $arrFields;
    }
    
    protected function setPicUrl($picurl)
    {
        $this->picurl = (string) $PicUrl;
        return $this;
    }
    
    public function getPicUrl()
    {
        return $this->picurl;
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