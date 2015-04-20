<?php
namespace Wechat\Request\Message;

class Text extends AbstractMessage
{
    protected $content = null;
    
    protected function fields()
    {
        $arrFields = parent::fields();
        $arrFields['Content'] = 'setContent';
        return $arrFields;
    }
    
    protected function setContent($content)
    {
        $this->content = (string) $content;
        return $this;
    }
    
    public function getContent()
    {
        return $this->content;
    }
}