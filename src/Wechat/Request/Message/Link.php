<?php
namespace Wechat\Request\Message;

class Link extends AbstractMessage
{
    protected $title       = null;
    protected $description = null;
    protected $url         = null;
    
    protected function fields()
    {
        $arrFields = parent::fields();
        $arrFields['Title']       = 'setTitle';
        $arrFields['Description'] = 'setDescription';
        $arrFields['Url']         = 'setUrl';
        return $arrFields;
    }
    
    protected function setTitle($title)
    {
        $this->title = (string) $title;
        return $this;
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    protected function setDescription($description)
    {
        $this->description = (string) $description;
        return $this;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    protected function setUrl($url)
    {
        $this->url = (string) $url;
        return $this;
    }
    
    public function getUrl()
    {
        return $this->url;
    }
}