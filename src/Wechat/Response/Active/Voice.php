<?php
namespace Wechat\Response\Active;

class Voice extends AbstractMessage
{
    protected $msgType = 'voice';
    
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
        $basic['voice']['media_id'] = $this->getMediaId();
        return $basic;
    }
}