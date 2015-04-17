<?php
namespace Wechat\Response\Active;

class Text extends AbstractMessage
{
    protected $msgType = 'text';
    
    private $content = null;
    
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }
    
    public function getContent()
    {
        return $this->content;
    }
    
    protected function buildJson(array $basic)
    {
        $basic['text']['content'] = $this->getContent();
        return $basic;
    }
}