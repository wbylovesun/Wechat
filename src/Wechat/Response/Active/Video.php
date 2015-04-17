<?php
namespace Wechat\Response\Active;

class Video extends AbstractMessage
{
    protected $msgType = 'video';
    
    private $mediaId      = null;
    private $thumbMediaId = null;
    
    public function setMediaId($mediaId)
    {
        $this->mediaId = $mediaId;
        return $this;
    }
    
    public function getMediaId()
    {
        return $this->mediaId;
    }
    
    public function setThumbMediaId($thumbMediaId)
    {
        $this->thumbMediaId = $thumbMediaId;
        return $this;
    }
    
    public function getThumbMediaId()
    {
        return $this->thumbMediaId;
    }
    
    protected function buildJson(array $basic)
    {
        $basic['video']['media_id']       = $this->getMediaId();
        $basic['video']['thumb_media_id'] = $this->getThumbMediaId();
        return $basic;
    }
}