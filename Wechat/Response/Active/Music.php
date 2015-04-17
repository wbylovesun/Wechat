<?php
namespace Wechat\Response\Active;

class Voice extends AbstractMessage
{
    protected $msgType = 'music';
    
    private $title        = null;
    private $description  = null;
    private $musicUrl     = null;
    private $hqMusicUrl   = null;
    private $thumbMediaId = null;
    
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    public function setMusicUrl($musicUrl)
    {
        $this->musicUrl = $musicUrl;
        return $this;
    }
    
    public function getMusicUrl()
    {
        return $this->musicUrl;
    }
    
    public function setHQMusicUrl($hqMusicUrl)
    {
        $this->hqMusicUrl = $hqMusicUrl;
        return $this;
    }
    
    public function getHQMusicUrl()
    {
        return $this->hqMusicUrl;
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
        if ($this->title) {
            $basic['music']['title'] = $this->getTitle();
        }
        if ($this->description) {
            $basic['music']['title'] = $this->getDescription();
        }
        $basic['music']['musicurl']       = $this->getMusicUrl();
        $basic['music']['hqmusicurl']     = $this->getHQMusicUrl();
        $basic['music']['thumb_media_id'] = $this->getThumbMediaId();
        return $basic;
    }
}