<?php
namespace Wechat\Response\Active;

class Image extends AbstractMessage
{
    protected $msgType = 'image';
    
    private $mediaId = null;
    
    public function setMediaId($mediaId)
    {
        $this->mediaId = $mediaId;
        return $this;
    }
    
    public function getMediaId()
    {
        return $this->mediaId;
    }
    
    protected function buildJson(array $basic)
    {
        $basic['image']['media_id'] = $this->getMediaId();
        return $basic;
    }
}